<?php namespace AppApi\ApiResponse\Middlewares;

use Closure;
use AppApi\ApiResponse\Enums\ResponseTypeEnum;

class ApiResourceMiddleware
{
    public function handle($request, Closure $next)
    {
        $routePatterns = config('appapi.apiresponse::ROUTE_PATTERNS', []);
        $matchesPattern = false;

        foreach ($routePatterns as $pattern) {
            if ($request->is($pattern)) {
                $matchesPattern = true;
                break;
            }
        }

        if (!$matchesPattern) {
            return $next($request);
        }

        $response = $next($request);
        $statusCode = $response->getStatusCode();

        $originalContent = $response->getContent();
        $decodedContent = json_decode($originalContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $response;
        }

        $decodedContent = is_array($decodedContent) ? $decodedContent : null;

        $response->headers->set('Content-Type', 'application/json');

        if ($decodedContent && $this->isApiResource($decodedContent)) {
            return $response;
        }

        $isSuccess = $statusCode >= 200 && $statusCode < 300;
        $keysToExclude = ['data', 'pagination', 'meta', 'links', 'auth'];
        $additional = array_filter($decodedContent, function ($key) use ($keysToExclude) {
            return !in_array($key, $keysToExclude);
        }, ARRAY_FILTER_USE_KEY);
        $content = [
            'type' => $isSuccess ? ResponseTypeEnum::SUCCESS : ResponseTypeEnum::ERROR,
            'is_toast' => false,
            'message' => $isSuccess ? 'Požiadavka bola úspešne spracovaná.' : 'Požiadavku nebolo možné spracovať.',
            'data' => $decodedContent['data'] ?? null,
            'pagination' => $decodedContent['pagination'] ??
                (isset($decodedContent['meta'], $decodedContent['links']) ?
                    ['meta' => $decodedContent['meta'], 'links' => $decodedContent['links']] : null),
            'auth' => $decodedContent['auth'] ?? null,
            'additional' => !empty($additional) ? $additional : null
        ];
        $filteredContent = array_filter($content, function ($value) {
            return !is_null($value);
        });

        $response->setContent(json_encode($filteredContent));

        return $response;
    }

    protected function isApiResource(array $data)
    {
        return isset(
            $data['type'],
            $data['is_toast'],
            $data['message']
        );
    }
}
