<?php

namespace Waynabox\ApiFormatter\Tests\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use PHPUnit\Framework\TestCase;

class PdfBinaryOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest(decbin(10));
        $formatter = new PdfBinaryOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertContains('1010', $output->getContent());
    }
}