<?php

namespace Waynabox\ApiFormatter\Tests\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonEncodedOutputFormatter;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class JsonEncodedOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('{"param1":"value 1","param2":"value 2"}', 200, new \StdClass());
        $formatter = new JsonEncodedOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertContains('{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{}}', $output);
    }

    public function testFormatterOutputsWithNoData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('', 200, new \StdClass());
        $formatter = new JsonEncodedOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertContains('{"status":200,"data":{},"error":{}}', $output);
    }
}
