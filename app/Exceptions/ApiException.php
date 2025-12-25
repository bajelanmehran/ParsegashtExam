<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected string|array $errors;
    protected int $statusCode;

    public function __construct(string|array $errors = "درخواست شما قابل پردازش نیست!", int $statusCode = 200)
    {
        parent::__construct(is_string($errors) ? $errors : 'Validation Error', $statusCode);
        $this->errors = $errors;
        $this->statusCode = $statusCode;
    }

    public function getErrors(): array|string
    {
        return $this->errors;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

}
