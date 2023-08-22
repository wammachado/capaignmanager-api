<?php
// exceptions/ValidationException.php
require_once 'exceptions/ApiException.php';

class ValidationException extends ApiException {
    public function __construct($message = 'Erro de validação', $statusCode = 400, Throwable $previous = null) {
        parent::__construct($message, $statusCode, $previous);
    }
}
