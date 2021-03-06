<?php

namespace Waynabox\ApiFormatter\Domain\Response;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormat;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterFactory;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;

class ApiResponseFactory
{
    /**
     * @param $responseData
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildCreatedResponse(
        $responseData,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_CREATED_CODE),
            new ApiResponseData($responseData),
            '',
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param $responseData
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildAcceptedResponse(
        $responseData,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE),
            new ApiResponseData($responseData),
            '',
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param string $errorMessage
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildAuthenticationFailedResponse(
        string $errorMessage,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_UNAUTHENTICATED_CODE),
            new ApiResponseData(),
            $errorMessage,
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param string $errorMessage
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildBadRequestResponse(
        string $errorMessage,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE),
            new ApiResponseData(),
            $errorMessage,
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param string $errorMessage
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildServerErrorResponse(
        string $errorMessage,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_SERVER_ERROR_CODE),
            new ApiResponseData(),
            $errorMessage,
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param string $errorMessage
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildNotFoundResponse(
        string $errorMessage,
        $formatType = OutputFormat::JSON_STRING
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_NOT_FOUND_CODE),
            new ApiResponseData(),
            $errorMessage,
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param $formatType
     * @return OutputFormatterInterface
     */
    private static function buildOutputFormatter($formatType)
    {
        return OutputFormatterFactory::build(
            OutputFormat::build($formatType)
        );
    }
}