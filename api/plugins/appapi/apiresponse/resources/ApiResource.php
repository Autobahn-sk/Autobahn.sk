<?php namespace AppApi\ApiResponse\Resources;

use AppApi\ApiResponse\Enums\ResponseTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    public static $wrap = 'data';

    public ResponseTypeEnum $type;

    public bool $isToast = false;

    public ?string $message = null;

    public ?array $errors = null;

    public mixed $data = null;

    public ?array $pagination = null;

    public ?array $auth = null;

    public function __construct(
        ResponseTypeEnum $type,
        bool $isToast = false,
        ?string $message = null,
        mixed $data = null,
        ?array $pagination = null,
        ?array $errors = null,
        ?array $auth = null,
        array $additional = []
    ) {
        $this->type = $type;
        $this->isToast = $isToast;
        $this->message = $message;
        $this->errors = $errors;
        $this->data = $data;
        $this->pagination = $pagination;
        $this->auth = $auth;
        $this->additional = !empty($additional) ? ['additional' => $additional] : [];
    }

    public function additional(array $data)
    {
        $this->additional = !empty($data) ? ['additional' => $data] : [];

        return $this;
    }

    public function with($request)
    {
        $data = [
            'type' => $this->type->value,
            'is_toast' => $this->isToast,
            'message' => $this->message,
            'errors' => $this->errors,
            'pagination' => $this->pagination,
            'auth' => $this->auth,
        ];

        $filteredData = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $filteredData;
    }

    public static function error(
        ?string $message = null,
        ?array $errors = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::ERROR,
            isToast: false,
            message: $message ?? 'Požiadavku nebolo možné spracovať.',
            errors: $errors,
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function errorToast(
        ?string $message = null,
        ?array $errors = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::ERROR,
            isToast: true,
            message: $message ?? 'Požiadavku nebolo možné spracovať.',
            errors: $errors,
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function warning(
        ?string $message,
        ?array $errors,
        mixed $data = null,
        ?array $auth,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::WARNING,
            isToast: false,
            message: $message ?? 'Požiadavku nebolo možné spracovať.',
            errors: $errors,
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function warningToast(
        ?string $message,
        ?array $errors,
        mixed $data = null,
        ?array $auth,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::WARNING,
            isToast: true,
            message: $message ?? 'Požiadavku nebolo možné spracovať.',
            errors: $errors,
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function success(
        ?string $message = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::SUCCESS,
            isToast: false,
            message: $message ?? 'Požiadavka bola úspešne spracovaná.',
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function successToast(
        ?string $message = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::SUCCESS,
            isToast: true,
            message: $message ?? 'Požiadavka bola úspešne spracovaná.',
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function info(
        ?string $message = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::INFO,
            isToast: false,
            message: $message ?? 'Požiadavka bola úspešne spracovaná.',
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public static function infoToast(
        ?string $message = null,
        mixed $data = null,
        ?array $auth = null,
        array $additional = []
    ) {
        return new static(
            type: ResponseTypeEnum::INFO,
            isToast: true,
            message: $message ?? 'Požiadavka bola úspešne spracovaná.',
            data: $data,
            auth: $auth,
            additional: $additional
        );
    }

    public function toArray($request)
    {
        return $this->data;
    }

    public function toResponse($request)
    {
        $response = parent::toResponse($request);

        if (is_null($this->data)) {
            $content = json_decode($response->getContent(), true);
            unset($content['data']);
            $response->setContent(json_encode($content));
        }

        return $response;
    }
}
