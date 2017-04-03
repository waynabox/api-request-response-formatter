<?php

namespace ApiFormatter\Domain\Response;

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

    public function statusDataProvider()
    {
        return [
            [BasicApiResponseStatus::STATUS_OK_CODE],
            [BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE],
            [BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE],
            [BasicApiResponseStatus::STATUS_UNAUTHORIZED_CODE],
            [BasicApiResponseStatus::STATUS_SERVER_ERROR_CODE],
        ];
    }
}
