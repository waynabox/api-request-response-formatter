<?php

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 9/03/17
 * Time: 15:58
 */
namespace ApiFormatter\Domain\Response;

use ApiFormatter\Domain\OutputFormatter\OutputFormat;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterFactory;

class ApiResponseFactory
{
    /**
     * @param $responseData
     * @param int $formatType
     * @return ApiResponse
     */
    public static function buildAcceptedResponse(
        $responseData,
        $formatType = OutputFormat::JSON
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
        $formatType = OutputFormat::JSON
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
        $formatType = OutputFormat::JSON
    ): ApiResponse {
        return new ApiResponse(
            new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE),
            new ApiResponseData(),
            $errorMessage,
            self::buildOutputFormatter($formatType)
        );
    }

    /**
     * @param $formatType
     * @return \ApiFormatter\Domain\OutputFormatter\PdfBinaryOutputFormatter|\ApiFormatter\Domain\OutputFormatter\JsonOutputFormatter
     */
    private static function buildOutputFormatter($formatType)
    {
        return OutputFormatterFactory::build(
            OutputFormat::build($formatType)
        );
    }
}