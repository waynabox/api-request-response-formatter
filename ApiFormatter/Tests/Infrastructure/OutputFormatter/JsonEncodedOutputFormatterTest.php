<?php

namespace ApiFormatter\Tests\Infrastructure\OutputFormatter;

use ApiFormatter\Infrastructure\OutputFormatter\JsonEncodedOutputFormatter;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class JsonEncodedOutputFormatterTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('{"param1":"value 1","param2":"value 2"}', ['status' => 200, 'error' => new \StdClass()]);
        $formatter = new JsonEncodedOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertEquals('{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{}}', $output);
    }
}
