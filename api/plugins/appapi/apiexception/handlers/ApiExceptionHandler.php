<?php namespace AppApi\ApiException\Handlers;

use AjaxException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use October\Rain\Auth\AuthException;
use October\Rain\Database\ModelException;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ForbiddenException;
use October\Rain\Exception\NotFoundException;
use October\Rain\Foundation\Exception\Handler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use AppApi\ApiException\Exceptions\BadRequestException as AppBadRequestException;
use AppApi\ApiException\Exceptions\ForbiddenException as AppForbiddenException;
use AppApi\ApiException\Exceptions\NotFoundException as AppNotFoundException;
use AppApi\ApiException\Exceptions\TooManyRequestsException as AppTooManyRequestsException;
use AppApi\ApiException\Exceptions\UnauthorizedException as AppUnauthorizedException;
use AppApi\ApiException\Exceptions\ValidationException as AppValidationException;
use AppApi\ApiResponse\Enums\ResponseTypeEnum;
use AppApi\ApiResponse\Resources\ApiResource;

class ApiExceptionHandler extends Handler
{
    protected $dontReport = [
        \October\Rain\Exception\AjaxException::class,
        \October\Rain\Exception\NotFoundException::class,
        \October\Rain\Exception\ForbiddenException::class,
        \October\Rain\Exception\ValidationException::class,
        \October\Rain\Exception\ApplicationException::class,
		AppBadRequestException::class,
		AppForbiddenException::class,
		AppNotFoundException::class,
    ];

    public function render($request, Throwable $exception)
    {
        $routePatterns = config('appapi.apiexception::ROUTE_PATTERNS', []);
        $isRefresh = $request->is(config('appapi.apiexception::REFRESH_TOKEN_ROUTE_PATTERN', null));
        $matchesPattern = false;

        foreach ($routePatterns as $pattern) {
            if ($request->is($pattern)) {
                $matchesPattern = true;
                break;
            }
        }

        if (!$matchesPattern) {
            return parent::render($request, $exception);
        }

        $response = ApiResource::error();
        $response->type = empty($exception->type) || !in_array($exception->type, ResponseTypeEnum::values())
            ? $response->type : $exception->type;
        $response->isToast = empty($exception->isToast) ? $response->isToast : $exception->isToast;
        $response->message = empty($exception->getMessage()) ? $response->message : $exception->getMessage();
        $response->errors = empty($exception->errors) ? $response->errors : $exception->errors;

        $statusCode = null;

        switch (get_class($exception)) {
                // MODEL EXCEPTION
            case ModelException::class:
                $statusCode = $exception->status;
                $response->errors = $exception->getErrors()->messages();
                break;

                // BAD REQUEST
            case AppBadRequestException::class:
            case ApplicationException::class:
            case AjaxException::class:
                $statusCode = Response::HTTP_BAD_REQUEST;
                break;

                // UNAUTHORIZED
            case TokenExpiredException::class:
                $response->message = 'Platnosť tokenu vypršala.';
                $response->errors = $isRefresh ?
                    ['refresh_token_expired' => true] : ['access_token_expired' => true];
                $response->isToast = false;
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;
            case TokenBlacklistedException::class:
                $response->message = 'Token bol zrušený.';
                $response->errors = $isRefresh ?
                    ['refresh_token_blacklisted' => true] : ['access_token_blacklisted' => true];
                $response->isToast = true;
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;
            case TokenInvalidException::class:
            case JWTException::class:
            case UnauthorizedHttpException::class:
                $response->message = 'Token chýba alebo je neplatný.';
                $response->errors = $isRefresh ?
                    ['refresh_token_invalid' => true] : ['access_token_invalid' => true];
                $response->isToast = true;
                $statusCode = Response::HTTP_UNAUTHORIZED;
                $previousException = $exception->getPrevious();
                switch (true) {
                    case $previousException instanceof TokenExpiredException:
                        $response->message = 'Platnosť tokenu vypršala.';
                        $response->errors = $isRefresh ?
                            ['refresh_token_expired' => true] : ['access_token_expired' => true];
                        $response->isToast = false;
                        break;
                    case $previousException instanceof TokenBlacklistedException:
                        $response->message = 'Token bol zrušený.';
                        $response->errors = $isRefresh ?
                            ['refresh_token_blacklisted' => true] : ['access_token_blacklisted' => true];
                        break;
                }
                break;
            case AppUnauthorizedException::class:
            case AuthException::class:
                $response->isToast = true;
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;

                // FORBIDDEN
            case AppForbiddenException::class:
            case $exception instanceof ForbiddenException:
                $response->isToast = true;
                $statusCode = Response::HTTP_FORBIDDEN;
                break;

                // NOT FOUND
            case NotFoundHttpException::class:
                $response->message = 'Služba sa nenašla. Skontrolujte adresu URL.';
                $statusCode = Response::HTTP_NOT_FOUND;
                break;

            case ModelNotFoundException::class:
                $response->message = array_last(explode('\\', $exception->getModel())) . ' model sa nenašiel.';
                $statusCode = Response::HTTP_NOT_FOUND;
                break;

            case NotFoundException::class:
            case AppNotFoundException::class:
                $statusCode = Response::HTTP_NOT_FOUND;
                break;

                // UNPROCESSABLE ENTITY - VALIDATION
            case ValidationException::class:
            case AppValidationException::class:
                $response->errors = [...$exception->errors(), ...($exception->errors ?? [])];
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;

                // TOO MANY REQUESTS
            case TooManyRequestsHttpException::class:
            case AppTooManyRequestsException::class:
                $response->isToast = true;
                $statusCode = Response::HTTP_TOO_MANY_REQUESTS;
                break;

                // INTERNAL SERVER ERROR|UNHANDLED ERRORS
            default:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

                if (method_exists($exception, 'getStatusCode')) {
                    $statusCode = $exception->getStatusCode();
                } elseif (method_exists($exception, 'getCode')) {
                    $statusCode = $exception->getCode();
                }

                if ($statusCode < 100 || $statusCode > 511 || !(is_int($statusCode))) {
                    $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                }

                $response->message = $statusCode >= 500 && !config('app.debug') ?
					'Vyskytla sa neočakávaná chyba.' : $exception->getMessage();
                $response->isToast = $statusCode >= 500 ? true : false;
        }

        return ($response)->response()->setStatusCode($statusCode);
    }
}
