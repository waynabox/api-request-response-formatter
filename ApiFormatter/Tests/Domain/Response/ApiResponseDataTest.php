<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 14/03/17
 * Time: 11:58
 */

namespace ApiFormatter\Tests\Domain\Response;

use ApiFormatter\Domain\Response\ApiResponseData;
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
}