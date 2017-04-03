<?php

namespace Waynabox\ApiFormatter\Domain\Response;

class BasicApiResponseStatus extends ApiResponseStatus
{
    const STATUS_OK_CODE = 200;
    const STATUS_BAD_REQUEST_CODE = 400;
    const STATUS_UNAUTHENTICATED_CODE = 401;
    const STATUS_UNAUTHORIZED_CODE = 403;
    const STATUS_SERVER_ERROR_CODE = 500;

    private $statusDescription = [
        self::STATUS_OK_CODE                => 'OK',
        self::STATUS_BAD_REQUEST_CODE       => 'Bad request',
        self::STATUS_UNAUTHENTICATED_CODE   => 'Unauthenticated',
        self::STATUS_UNAUTHORIZED_CODE      => 'Unauthorized',
        self::STATUS_SERVER_ERROR_CODE      => 'Server error',
    ];

    protected function statusDescription(): array
    {
        return $this->statusDescription;
    }

    public function isResponseStatusOK(): bool
    {
        return $this->statusCode() == self::STATUS_OK_CODE;
    }
}