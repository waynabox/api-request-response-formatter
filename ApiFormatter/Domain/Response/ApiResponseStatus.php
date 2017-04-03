<?php

namespace Waynabox\ApiFormatter\Domain\Response;

abstract class ApiResponseStatus
{
    private $statusCode;

    public function __construct($statusCode)
    {
        if(!array_key_exists($statusCode, $this->statusDescription())) {
            throw new ApiResponseStatusWrongCodeException("The response status '$statusCode' does not exists.'");
        }

        $this->statusCode = $statusCode;
    }

    public function statusCode() {
        return $this->statusCode;
    }

    abstract protected function statusDescription(): array ;

    abstract public function isResponseStatusOK(): bool ;
}