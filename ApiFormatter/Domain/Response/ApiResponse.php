<?php

namespace ApiFormatter\Domain\Response;

class ApiResponse
{
    /**
     * @var ApiResponseStatus
     */
    private $status;

    /**
     * @var ApiResponseDataInterface
     */
    private $apiResponseData;

    /**
     * @var string
     */
    private $mainErrorMessage;

    /**
     * @var array
     */
    private $errorList = [];

    public function __construct(ApiResponseStatus $status, ApiResponseDataInterface $data, string $mainErrorMessage)
    {
        $this->status = $status;
        $this->apiResponseData = $data;
        $this->mainErrorMessage = $mainErrorMessage;

        if($this->isResponseOk() && !empty($mainErrorMessage)) {
            throw new ApiResponseWithErrorWhenNoErrorStatus();
        }
    }

    public function json()
    {
        $data = [
            'status' => $this->statusCode(),
            'data' => $this->apiResponseData(),
            'error' => '{}'
        ];

        if(!$this->isResponseOk()) {
            $data = $this->addErrorsToResponse($data);
        }

        return json_encode($data);
    }

    public function statusCode()
    {
        return $this->status->statusCode();
    }

    public function addError(string $errorKey, array $errorData)
    {
        if($this->isResponseOk()) {
            throw new ApiResponseWithErrorWhenNoErrorStatus();
        }

        $this->errorList[$errorKey] = $errorData;
    }

    private function addErrorsToResponse($data): array
    {
        $data ['error'] = [
            'message' => $this->mainErrorMessage
        ];

        foreach ($this->errorList as $errorKey => $errorData) {
            $data['error']['errors'][$errorKey] = $errorData;
        }

        return $data;
    }

    private function apiResponseData()
    {
        return $this->apiResponseData->data();
    }

    private function isResponseOk()
    {
        return $this->status->isResponseStatusOK();
    }
}