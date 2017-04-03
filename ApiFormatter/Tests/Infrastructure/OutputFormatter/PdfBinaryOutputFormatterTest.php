<?php

namespace ApiFormatter\Tests\Infrastructure\OutputFormatter;

use ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class PdfBinaryOutputFormatterTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest(decbin(10));
        $formatter = new PdfBinaryOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertEquals('1010', $output);
    }
}