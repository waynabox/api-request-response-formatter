<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 14/03/17
 * Time: 11:58
 */

namespace Waynabox\ApiFormatter\Tests\Domain\Response;

use Waynabox\ApiFormatter\Domain\Response\ApiResponseData;
use PHPUnit\Framework\TestCase;

class ApiResponseDataTest extends TestCase
{
    public function testObjectInstantiationWorksFine()
    {
        /** arrange */
        $data = [
            'param1' => 'value 1',
            'param2' => 'value 2'
        ];
        /** act */
        $apiResponseData = new ApiResponseData($data);
        /** assert */
        $this->assertEquals($data, $apiResponseData->data());


    }

    public function testWithJsonAsDataWorksFine()
    {
        /** arrange */
        $data = [
            'param1' => 'value 1',
            'param2' => 'value 2'
        ];
        /** act */
        $apiResponseData = new ApiResponseData(json_encode($data));
        /** assert */
        $this->assertEquals(json_encode($data), $apiResponseData->data());
    }
}