<?php

namespace Waynabox\ApiFormatter\Domain\Response;

use PHPUnit\Framework\TestCase;

class ApiResponseStatusTest extends TestCase
{
    public function testApiResponseStatusWithWrongStatusLaunchException()
    {
        $this->expectException(ApiResponseStatusWrongCodeException::class);

        $nonExistentStatus = 'wrongStatus';
        new BasicApiResponseStatus($nonExistentStatus);
    }

    /**
     * @dataProvider statusDataProvider
     */
    public function testApiResponseStatusWithStatusOk($status)
    {
        $apiResponseStatus = new BasicApiResponseStatus($status);
        $this->assertEquals($status, $apiResponseStatus->statusCode());
    }


    public function testApiResponseIsStatusOkWith200Response(){
        $response = new BasicApiResponseStatus(200);
        $this->assertTrue($response->isResponseStatusOK());
    }

    public function testApiResponseIsStatusOkWith201Response(){
        $response = new BasicApiResponseStatus(201);
        $this->assertTrue($response->isResponseStatusOK());
    }

    public function testApiResponseIsStatusNotOkWith400Response(){
        $response = new BasicApiResponseStatus(400);
        $this->assertFalse($response->isResponseStatusOK());
    }

    public function testApiResponseIsStatusNotOkWith401Response(){
        $response = new BasicApiResponseStatus(401);
        $this->assertFalse($response->isResponseStatusOK());
    }

    public function testApiResponseIsStatusNotOkWith403Response(){
        $response = new BasicApiResponseStatus(403);
        $this->assertFalse($response->isResponseStatusOK());
    }

    public function testApiResponseIsStatusNotOkWith500Response(){
        $response = new BasicApiResponseStatus(500);
        $this->assertFalse($response->isResponseStatusOK());
    }

    public function statusDataProvider()
    {
        return [
            [BasicApiResponseStatus::STATUS_OK_CODE],
            [BasicApiResponseStatus::STATUS_CREATED_CODE],
            [BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE],
            [BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE],
            [BasicApiResponseStatus::STATUS_UNAUTHORIZED_CODE],
            [BasicApiResponseStatus::STATUS_SERVER_ERROR_CODE],
        ];
    }
}
