<?php

namespace ApiFormatter\Tests\Domain\Request;

use ApiFormatter\Domain\Request\ApiRequest;
use ApiFormatter\Domain\Request\ApiRequestBadException;
use PHPUnit\Framework\TestCase;


class ApiRequestTest extends TestCase
{
    public function testApiRequestBadExceptionParametersWithNoParameters()
    {
        $parameters = [];

        $this->expectException(ApiRequestBadException::class);
        new ApiRequestMock($parameters);
    }

    public function testApiRequestBadExceptionParametersWithNoDataParameters()
    {
        $parameters = [
            'test' => 'test'
        ];

        $this->expectException(ApiRequestBadException::class);
        new ApiRequestMock($parameters);
    }

    public function testApiRequestBadExceptionParametersWithNoMockParameters()
    {
        $parameters = [
            'data' => ''
        ];

        $this->expectException(ApiRequestBadException::class);
        new ApiRequestMock($parameters);
    }

    public function testApiRequestBadExceptionParametersWithBadMockParameters()
    {
        $parameters = [
            'data' => [
                'badTest' => 'badTest'
            ]
        ];

        $this->expectException(ApiRequestBadException::class);
        new ApiRequestMock($parameters);
    }

    public function testApiRequestBadExceptionParametersWithGoodMockParameters()
    {
        $parameters = [
            'data' => [
                'goodTest' => 'goodTest'
            ]
        ];

        $apiRequest = new ApiRequestMock($parameters);
        $this->assertInstanceOf(ApiRequest::class, $apiRequest);
        $this->assertEquals($parameters['data'], $apiRequest->parameters());
    }
}
