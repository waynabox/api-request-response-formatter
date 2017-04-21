<?php

namespace Waynabox\ApiFormatter\Tests\Domain\OutputFormatter;

use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\HtmlOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonStringOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonOutputFormatter;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormat;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterFactory;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;
use PHPUnit\Framework\TestCase;


class OutputFormatterFactoryTest extends TestCase
{
    public function testFactoryWorksProperlyWithEachSingleFormatterCreation()
    {
        foreach (OutputFormat::ALLOWED as $outputFormatId) {
            $formatter = OutputFormatterFactory::build(OutputFormat::build($outputFormatId));
            $instanceNameToTest = $this->getInstanceNameToTest($outputFormatId);
            $this->assertInstanceOf($instanceNameToTest, $formatter);
        }
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

    private function getInstanceNameToTest($outputFormatId)
    {
        switch ($outputFormatId) {
            case OutputFormat::PLAIN_TEXT:
                return PlaintextOutputFormatter::class;
                break;
            case OutputFormat::JSON:
                return JsonOutputFormatter::class;
                break;
            case OutputFormat::BINARY_PDF:
                return PdfBinaryOutputFormatter::class;
                break;
            case OutputFormat::JSON_STRING:
                return JsonStringOutputFormatter::class;
                break;
            case OutputFormat::HTML:
                return HtmlOutputFormatter::class;
                break;
        }
        throw new \Exception("Output formatter with id $outputFormatId is pending to test on factory test");
    }
}
