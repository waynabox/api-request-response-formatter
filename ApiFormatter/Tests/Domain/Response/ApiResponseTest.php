<?php

namespace ApiFormatter\Tests\Domain\Response;

use ApiFormatter\Domain\Response\ApiResponse;
use ApiFormatter\Domain\Response\ApiResponseData;
use ApiFormatter\Domain\Response\ApiResponseWithErrorWhenNoErrorStatus;
use ApiFormatter\Domain\Response\BasicApiResponseStatus;
use PHPUnit\Framework\TestCase;

class ApiResponseTest extends TestCase
{
    public function testApiResponseOKStatus()
    {
        $param1Name = 'param1';
        $param2Name = 'param2';
        $param3Name = 'paramN';
        $param1 = 'test_data_1';
        $param2 = [
            'test_data_2' => 'test_data_2'
        ];
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = '';
        $jsonResponse = json_encode([
            'status' => BasicApiResponseStatus::STATUS_OK_CODE,
            'data' => [
                $param1Name => $param1,
                $param2Name => $param2,
                $param3Name => $param3,
            ],
            'error' => '{}'
        ]);

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        $response = new ApiResponse($status, $data, $mainErrorMessage);

        $this->assertEquals($jsonResponse, $response->json());
    }

    public function testApiResponseOKStatusWithJsonDataInsteadArray()
    {
        $data = [
            'param_test_data_1' => 'value_test_data_1',
            'param_test_data_2' => 'value_test_data_2',
            'param_test_data_3' => 'value_test_data_3'
        ];
        $apìResponseData = new ApiResponseData(json_encode($data));

        $mainErrorMessage = '';
        $jsonResponse = json_encode([
            'status' => BasicApiResponseStatus::STATUS_OK_CODE,
            'data' => $data,
            'error' => '{}'
        ]);

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        $response = new ApiResponse($status, $apìResponseData, $mainErrorMessage);

        $this->assertEquals($jsonResponse, $response->json());
    }

    public function testApiResponseOKStatusWithMainErrorMessageLaunchAnException()
    {
        $this->expectException(ApiResponseWithErrorWhenNoErrorStatus::class);

        $param1 = 'test_data_1';
        $param2 = 'test_data_2';
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = 'A message that should not be';

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        new ApiResponse($status, $data, $mainErrorMessage);
    }

    public function testApiResponseBadRequestStatusOnlyMainError()
    {
        $param1Name = 'param1';
        $param2Name = 'param2';
        $param3Name = 'paramN';
        $param1 = 'test_data_1';
        $param2 = [
            'test_data_2' => 'test_data_2'
        ];
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = 'Bad paramenters request';
        $jsonResponse = json_encode([
            'status' => BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE,
            'data' => [
                $param1Name => $param1,
                $param2Name => $param2,
                $param3Name => $param3,
            ],
            'error' => [
                'message' => $mainErrorMessage,
            ]
        ]);

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE);
        $response = new ApiResponse($status, $data, $mainErrorMessage);

        $this->assertEquals($jsonResponse, $response->json());
    }

    public function testApiResponseBadRequestStatusWithMultipleErrors()
    {
        $param1Name = 'param1';
        $param2Name = 'param2';
        $param3Name = 'paramN';
        $param1 = 'test_data_1';
        $param2 = [
            'test_data_2' => 'test_data_2'
        ];
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = 'Bad parameters request';
        $error1Name = 'error1';
        $error2Name = 'error2';
        $error1 = [
            'error_field' => 'field',
            'error_message' => 'message'
        ];
        $error2 = [
            'error_message' => 'message'
        ];
        $jsonResponse = json_encode([
            'status' => BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE,
            'data' => [
                $param1Name => $param1,
                $param2Name => $param2,
                $param3Name => $param3,
            ],
            'error' => [
                'message' => $mainErrorMessage,
                'errors' => [
                    $error1Name => $error1,
                    $error2Name => $error2
                ]
            ]
        ]);

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE);
        $response = new ApiResponse($status, $data, $mainErrorMessage);
        $response->addError($error1Name, $error1);
        $response->addError($error2Name, $error2);

        $this->assertEquals($jsonResponse, $response->json());
    }

    public function testApiResponseOkStatusWithMainErrorMessageLaunchException()
    {
        $this->expectException(ApiResponseWithErrorWhenNoErrorStatus::class);

        $param1 = 'test_data_1';
        $param2 = 'test_data_2';
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = 'Bad parameters request';
        $error1Name = 'error1';
        $error1 = [
            'error_field' => 'field',
            'error_message' => 'message'
        ];

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        $response = new ApiResponse($status, $data, $mainErrorMessage);
        $response->addError($error1Name, $error1);
    }

    public function testApiResponseOKStatusLaunchExceptionWhenAddingError()
    {
        $this->expectException(ApiResponseWithErrorWhenNoErrorStatus::class);

        $param1 = 'test_data_1';
        $param2 = 'test_data_2';
        $param3 = 'test_data_3';
        $data = new ApiResponseDataMock($param1, $param2, $param3);

        $mainErrorMessage = '';
        $error1Name = 'error1';
        $error1 = [
            'error_field' => 'field',
            'error_message' => 'message'
        ];

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        $response = new ApiResponse($status, $data, $mainErrorMessage);
        $response->addError($error1Name, $error1);
    }
}
