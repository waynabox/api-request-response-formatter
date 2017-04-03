<?php

namespace Waynabox\ApiFormatter\Tests\Domain\Request;

use Waynabox\ApiFormatter\Domain\Request\ApiRequest;

class ApiRequestMock extends ApiRequest
{

    /**
     * @param array $parameters
     * @return bool
     */
    protected function validateApiRequestParameters(array $parameters): bool
    {
        if (!isset($parameters['goodTest'])) {
            return false;
        }

        return true;
    }
}