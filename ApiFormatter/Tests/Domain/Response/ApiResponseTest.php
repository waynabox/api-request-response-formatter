<?php

namespace Waynabox\ApiFormatter\Tests\Domain\Response;

use PHPUnit\Framework\TestCase;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormat;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterFactory;
use Waynabox\ApiFormatter\Domain\Response\ApiResponse;
use Waynabox\ApiFormatter\Domain\Response\ApiResponseWithErrorWhenNoErrorStatus;
use Waynabox\ApiFormatter\Domain\Response\BasicApiResponseStatus;

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

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_OK_CODE);
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $response = new ApiResponse($status, $data, $mainErrorMessage, $formatter);

        $decodedResponse = json_decode($response->output()->getContent(), true);
        $this->assertEquals(BasicApiResponseStatus::STATUS_OK_CODE, $decodedResponse['status']);
        $this->assertEquals([$param1Name => $param1, $param2Name => $param2, $param3Name => $param3],
            $decodedResponse['data']);
        $this->assertEmpty($decodedResponse['error']);
        $this->assertNotFalse(strtotime($decodedResponse['date']));
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
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        new ApiResponse($status, $data, $mainErrorMessage, $formatter);
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

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE);
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $response = new ApiResponse($status, $data, $mainErrorMessage, $formatter);

        $decodedResponse = json_decode($response->output()->getContent(), true);
        $this->assertEquals(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE, $decodedResponse['status']);
        $this->assertEquals([$param1Name => $param1, $param2Name => $param2, $param3Name => $param3],
            $decodedResponse['data']);
        $this->assertEquals('Bad paramenters request', $decodedResponse['error']['message']);
        $this->assertNotFalse(strtotime($decodedResponse['date']));
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

        $status = new BasicApiResponseStatus(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE);
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $response = new ApiResponse($status, $data, $mainErrorMessage, $formatter);
        $response->addError($error1Name, $error1);
        $response->addError($error2Name, $error2);

        $decodedResponse = json_decode($response->output()->getContent(), true);
        $this->assertEquals(BasicApiResponseStatus::STATUS_BAD_REQUEST_CODE, $decodedResponse['status']);
        $this->assertEquals([$param1Name => $param1, $param2Name => $param2, $param3Name => $param3],
            $decodedResponse['data']);
        $this->assertEquals($mainErrorMessage, $decodedResponse['error']['message']);
        $this->assertEquals(['error1' => $error1, 'error2' => $error2], $decodedResponse['error']['errors']);
        $this->assertNotFalse(strtotime($decodedResponse['date']));
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
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $response = new ApiResponse($status, $data, $mainErrorMessage, $formatter);
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
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $response = new ApiResponse($status, $data, $mainErrorMessage, $formatter);
        $response->addError($error1Name, $error1);
    }
}
