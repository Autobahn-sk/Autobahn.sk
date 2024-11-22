<?php namespace AppApi\ApiException\Exceptions;

use Illuminate\Validation\ValidationException as BaseValidationException;

class ValidationException extends BaseValidationException
{
    public bool $isToast;

    public ?array $errors;

    public function __construct(
        $validator,
        $response = null,
        $errorBag = 'default',
        bool $isToast = false,
        ?array $errors = null
    ) {
        parent::__construct($validator, $response, $errorBag);

        $this->isToast = $isToast;
        $this->errors = $errors;
    }
}
