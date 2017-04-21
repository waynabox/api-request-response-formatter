<?php

namespace Waynabox\ApiFormatter\Domain\Response;

class BasicApiResponseStatus extends ApiResponseStatus
{
    const STATUS_OK_CODE = 200;
    const STATUS_CREATED_CODE = 201;
    const STATUS_BAD_REQUEST_CODE = 400;
    const STATUS_UNAUTHENTICATED_CODE = 401;
    const STATUS_UNAUTHORIZED_CODE = 403;
    const STATUS_NOT_FOUND_CODE = 404;
    const STATUS_SERVER_ERROR_CODE = 500;

    private $statusDescription = [
        self::STATUS_OK_CODE => 'OK',
        self::STATUS_CREATED_CODE => 'Created',
        self::STATUS_BAD_REQUEST_CODE => 'Bad request',
        self::STATUS_UNAUTHENTICATED_CODE => 'Unauthenticated',
        self::STATUS_UNAUTHORIZED_CODE => 'Unauthorized',
        self::STATUS_NOT_FOUND_CODE => 'Not Found',
        self::STATUS_SERVER_ERROR_CODE => 'Server error',
    ];

    /**
     * @return bool
     */
    public function isResponseStatusOK(): bool
    {
        return in_array($this->statusCode(), [self::STATUS_OK_CODE, self::STATUS_CREATED_CODE]);
    }

    /**
     * @return array
     */
    protected function statusDescription(): array
    {
        return $this->statusDescription;
    }
}