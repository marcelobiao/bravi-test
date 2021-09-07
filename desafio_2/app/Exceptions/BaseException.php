<?php

namespace App\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    protected $response = [];
    protected $exceptionCode = 0;

    public function __construct($exceptionCode = 0, Exception $previous = null) 
    {
        $this->exceptionCode = $exceptionCode;
        parent::__construct(
            array_key_exists($exceptionCode, $this->response) ? $this->response[$exceptionCode]['message'] : 'Erro Interno',
            $exceptionCode,
            $previous);
    }

    public function getHttpStatusCode()
    {
        return array_key_exists($this->exceptionCode, $this->response) ? $this->response[$this->exceptionCode]['httpStatusCode'] : 500;
    }
}
