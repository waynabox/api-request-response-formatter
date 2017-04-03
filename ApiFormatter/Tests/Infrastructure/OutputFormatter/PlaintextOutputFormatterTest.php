<?php

namespace ApiFormatter\Tests\Infrastructure\OutputFormatter;

use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;
use PHPUnit\Framework\TestCase;

class PlaintextOutputFormatterTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('my plain text');
        $formatter = new PlaintextOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertEquals('my plain text', $output);
    }
}