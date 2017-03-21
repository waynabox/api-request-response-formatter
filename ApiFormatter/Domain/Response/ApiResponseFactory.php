<?php

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 9/03/17
 * Time: 15:58
 */
namespace ApiFormatter\Domain\Response;

class ApiResponseFactory
{
    /**
     * @param mixed $responseData
     * @return ApiResponse
     */
    public static function buildAcceptedResponse($responseData): ApiResponse
    {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE),
            new ApiResponseData($responseData),
            ''
        );
    }

    /**
     * @param string $errorMessage
     * @return ApiResponse
     */
    public static function buildAuthenticationFailedResponse(
        string $errorMessage
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE),
            new ApiResponseData(),
            $errorMessage
        );
    }

    /**
     * @param string $errorMessage
     * @return ApiResponse
     */
    public static function buildBadRequestResponse(
        string $errorMessage
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE),
            new ApiResponseData(),
            $errorMessage
        );
    }
}