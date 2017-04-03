<?php

namespace Waynabox\ApiFormatter\Tests\Domain\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormat;
use PHPUnit\Framework\TestCase;


class OutputFormatTest extends TestCase
{
    public function testAllowedTypesAreProperlyDefined()
    {
        $expectedAllowed = [
            OutputFormat::PLAIN_TEXT,
            OutputFormat::JSON,
            OutputFormat::BINARY_PDF,
            OutputFormat::JSON_ENCODED
        ];
        $this->assertEquals($expectedAllowed, OutputFormat::ALLOWED);
    }

    public function testGetters()
    {
        $outputFormat = OutputFormat::build(OutputFormat::PLAIN_TEXT);
        $this->assertEquals(1, $outputFormat->type());
    }

    /**
     * @expectedException \Waynabox\ApiFormatter\Domain\OutputFormatter\Exception\FormatTypeNotAllowedException
     */
    public function testBuildOnWrongTypeReturnsException()
    {
        OutputFormat::build(0);
    }
}
