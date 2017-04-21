<?php

namespace Waynabox\ApiFormatter\Tests\Domain\Response;

use Waynabox\ApiFormatter\Domain\Response\ApiResponseFactory;
use Waynabox\ApiFormatter\Domain\Response\BasicApiResponseStatus;
use PHPUnit\Framework\TestCase;

class ApiResponseFactoryTest extends TestCase
{
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
    }

    public function testFactoryReturnsAuthenticationFailedResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildAuthenticationFailedResponse('bad password');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE, $response->statusCode());
    }

    public function testFactoryReturnsBadRequestResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildBadRequestResponse('messy requested data');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE, $response->statusCode());
    }

    public function testFactoryReturnsNotFoundResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildNotFoundResponse('not found');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_NOT_FOUND_CODE, $response->statusCode());
    }

    public function testFactoryReturnsCreatedResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildCreatedResponse('Created successfully');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_CREATED_CODE, $response->statusCode());
    }

    public function testFactoryReturnsServerErrorResponse()
    {
        /** act */
        $response = ApiResponseFactory::buildServerErrorResponse('Created successfully');

        /** assert */
        $this->assertEquals(BasicApiResponseStatus::STATUS_SERVER_ERROR_CODE, $response->statusCode());
    }
}