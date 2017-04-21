<?php

namespace Waynabox\ApiFormatter\Domain\OutputFormatter;


use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\HtmlOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonStringOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\JsonOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use Waynabox\ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;


class OutputFormatterFactory
{
    public static function build(OutputFormat $outputFormat)
    {
        switch ($outputFormat->type()) {
            case OutputFormat::PLAIN_TEXT:
                return new PlaintextOutputFormatter();
            case OutputFormat::JSON:
                return new JsonOutputFormatter();
            case OutputFormat::BINARY_PDF:
                return new PdfBinaryOutputFormatter();
            case OutputFormat::JSON_STRING:
                return new JsonStringOutputFormatter();
            case OutputFormat::HTML:
                return new HtmlOutputFormatter();
            default:
                throw new \Exception("Not implemented on factory yet");
        }
    }

}