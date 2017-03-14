<?php

namespace ApiFormatter\Tests\Domain\OutputFormatter;

use ApiFormatter\Domain\OutputFormatter\JsonOutputFormatter;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class JsonOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest(200, json_encode(['param1' => 'value 1', 'param2' => 'value 2']));
        $formatter = new JsonOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertEquals(200,$output->getStatusCode());
        $this->assertEquals('{"param1":"value 1","param2":"value 2"}',$output->getContent());
    }
}