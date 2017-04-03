<?php

namespace ApiFormatter\Tests\Domain\Response;

use ApiFormatter\Domain\Response\ApiResponseFactory;
use ApiFormatter\Domain\Response\BasicApiResponseStatus;
use PHPUnit\Framework\TestCase;

class ApiResponseFactoryTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testFactoryReturnsAcceptedResponse()
    {
        /** arrange */
        $data = json_encode([
            'param 1' => 'value 1',
            'param 2' => 'value 2'
        ]);

        /** act */
        $response = ApiResponseFactory::buildAcceptedResponse($data);

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_OK_CODE, $response->statusCode());
        $this->assertEquals('{"status":200,"data":{"param 1":"value 1","param 2":"value 2"},"error":{}}',
            $response->output());
    }

    /**
     * @runInSeparateProcess
     */
    public function testFactoryReturnsAuthenticationFailedResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildAuthenticationFailedResponse('bad password');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE, $response->statusCode());
        $this->assertEquals('{"status":401,"data":[],"error":{"message":"bad password"}}', $response->output());
    }

    /**
     * @runInSeparateProcess
     */
    public function testFactoryReturnsBadRequestResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildBadRequestResponse('messy requested data');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE, $response->statusCode());
        $this->assertEquals('{"status":400,"data":[],"error":{"message":"messy requested data"}}', $response->output());
    }
}