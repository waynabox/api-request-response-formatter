<?php

namespace Waynabox\ApiFormatter\Domain\Response;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

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

    /**
     * @var OutputFormatterInterface
     */
    private $outputFormatter;

    /**
     * ApiResponse constructor.
     * @param ApiResponseStatus $status
     * @param ApiResponseDataInterface $data
     * @param string $mainErrorMessage
     * @param OutputFormatterInterface $outputFormatter
     * @throws ApiResponseWithErrorWhenNoErrorStatus
     */
    public function __construct(
        ApiResponseStatus $status,
        ApiResponseDataInterface $data,
        string $mainErrorMessage,
        OutputFormatterInterface $outputFormatter
    ) {
        $this->status = $status;
        $this->apiResponseData = $data;
        $this->mainErrorMessage = $mainErrorMessage;
        $this->outputFormatter = $outputFormatter;

        if ($this->isResponseOk() && !empty($mainErrorMessage)) {
            throw new ApiResponseWithErrorWhenNoErrorStatus();
        }
    }

    /**
     * @return mixed
     */
    public function output()
    {
        return $this->outputFormatter->format(
            new OutputFormatterRequest(
                $this->apiResponseData(),
                $this->outputStatus(),
                $this->statusCode(),
                $this->getErrors()
            )
        );
    }

    /**
     * @return string
     */
    private function outputStatus(){
        if($this->status->isResponseStatusOK()){
            return 'OK';
        }
        return 'KO';
    }

    /**
     * @return mixed
     */
    public function statusCode()
    {
        return $this->status->statusCode();
    }

    /**
     * @param string $errorKey
     * @param array $errorData
     * @throws ApiResponseWithErrorWhenNoErrorStatus
     */
    public function addError(string $errorKey, array $errorData)
    {
        if ($this->isResponseOk()) {
            throw new ApiResponseWithErrorWhenNoErrorStatus();
        }

        $this->errorList[$errorKey] = $errorData;
    }

    /**
     * @return array
     */
    private function getErrors()
    {
        $errors = new \stdClass();
        if (!$this->isResponseOk()) {
            $errors = $this->addErrorsToResponse();
        }
        return $errors;
    }

    /**
     * @return array
     */
    private function addErrorsToResponse(): array
    {
        $data = [
            'message' => $this->mainErrorMessage
        ];

        foreach ($this->errorList as $errorKey => $errorData) {
            $data['errors'][$errorKey] = $errorData;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    private function apiResponseData()
    {
        return $this->apiResponseData->data();
    }

    /**
     * @return bool
     */
    private function isResponseOk()
    {
        return $this->status->isResponseStatusOK();
    }
}