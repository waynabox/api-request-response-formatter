<?php

namespace Waynabox\ApiFormatter\Tests\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;
use PHPUnit\Framework\TestCase;

class PlaintextOutputFormatterTest extends TestCase
{
    public function testFormatterOutputsTheProperFormattedData()
    {
        /** arrange */
        $request = new OutputFormatterRequest('my plain text');
        $formatter = new PlaintextOutputFormatter($request);

        /** act */
        $output = $formatter->format($request);

        /** assert */
        $this->assertContains('my plain text', $output->getContent());
    }
}