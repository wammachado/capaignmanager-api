<?php
// exceptions/NotFoundException.php
require_once 'exceptions/ApiException.php';

class NotFoundException extends ApiException {
    public function __construct($message = 'Recurso não encontrado', $statusCode = 404, Throwable $previous = null) {
        parent::__construct($message, $statusCode, $previous);
    }
}
