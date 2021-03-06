<?php

namespace Waynabox\ApiFormatter\Tests\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonOutputFormatter;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class JsonOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest(['param1' => 'value 1', 'param2' => 'value 2'], 'OK', 200, new \StdClass());
        $formatter = new JsonOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);
        $decoded = json_decode($output->getContent(), true);

        /** assert */
        $this->assertEquals('OK', $decoded['status']);
        $this->assertEmpty($decoded['error']);
        $this->assertNotFalse(strtotime($decoded['date']));
        $this->assertEquals(['param1' => 'value 1', 'param2' => 'value 2'], $decoded['data']);
    }
}