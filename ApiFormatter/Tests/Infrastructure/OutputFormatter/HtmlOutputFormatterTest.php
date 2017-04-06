<?php

namespace Waynabox\ApiFormatter\Tests\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\HtmlOutputFormatter;
use PHPUnit\Framework\TestCase;

class HtmlOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('<html></html>');
        $formatter = new HtmlOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertContains('<html></html>', $output->getContent());
    }
}