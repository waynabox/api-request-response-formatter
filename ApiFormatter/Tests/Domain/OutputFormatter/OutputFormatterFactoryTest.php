<?php

namespace ApiFormatter\Tests\Domain\OutputFormatter;

use ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use ApiFormatter\Infrastructure\OutputFormatter\JsonOutputFormatter;
use ApiFormatter\Domain\OutputFormatter\OutputFormat;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterFactory;
use ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;
use PHPUnit\Framework\TestCase;


class OutputFormatterFactoryTest extends TestCase
{
    public function testFactoryWorksProperlyWithEachSingleFormatterCreation()
    {
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::PLAIN_TEXT));
        $this->assertInstanceOf(PlaintextOutputFormatter::class, $formatter);
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::JSON));
        $this->assertInstanceOf(JsonOutputFormatter::class, $formatter);
        $formatter = OutputFormatterFactory::build(OutputFormat::build(OutputFormat::BINARY_PDF));
        $this->assertInstanceOf(PdfBinaryOutputFormatter::class, $formatter);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Not implemented on factory yet
     */
    public function testFactoryThrowsErrorWhenNotImplementedOutputFormatHasPassed()
    {
        /**
         * arrange
         */
        /** @var OutputFormat|\PHPUnit_Framework_MockObject_MockObject $outputFormatMock */
        $outputFormatMock = $this->getMockBuilder(OutputFormat::class)
            ->disableOriginalConstructor()
            ->getMock();
        $outputFormatMock->expects($this->once())
            ->method('type')
            ->willReturn(0);
        /**
         * act
         */
        OutputFormatterFactory::build($outputFormatMock);
    }
}
