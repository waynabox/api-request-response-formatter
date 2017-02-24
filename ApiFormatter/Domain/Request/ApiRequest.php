<?php

namespace ApiFormatter\Domain\Request;

abstract class ApiRequest
{
    /**
     * @var array
     */
    private $requestParameters;

    /**
     * ApiRequest constructor.
     * @param array $request
     * @throws ApiRequestBadException
     */
    public function __construct(array $request)
    {
        if(!isset($request['data']) || !is_array($request['data'])) {
            throw new ApiRequestBadException('The request needs a data element');
        }

        if(!$this->validateApiRequestParameters($request['data'])) {
            throw new ApiRequestBadException('The request needs a data element');
        }

        $this->requestParameters = $request['data'];
    }

    /**
     * @param array $parameters
     * @return bool
     */
    abstract protected function validateApiRequestParameters(array $parameters): bool ;
}