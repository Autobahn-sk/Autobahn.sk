<?php namespace AppApi\ApiException\Exceptions;

use Exception;
use AppApi\ApiResponse\Enums\ResponseTypeEnum;

class BaseException extends Exception
{
    public bool $isToast;

    public ?array $errors;

    public ?array $data;

    public ResponseTypeEnum $type;

    public function __construct(
        string $message,
        bool $isToast = false,
        ResponseTypeEnum $type = ResponseTypeEnum::ERROR,
        ?array $errors = null,
        ?array $data = null
    ) {
        parent::__construct($message);
        $this->isToast = $isToast;
        $this->errors = $errors;
        $this->type = $type;
        $this->data = $data;
    }
}
