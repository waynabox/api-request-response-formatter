<?php

namespace ApiFormatter\Domain\OutputFormatter;


use ApiFormatter\Infrastructure\OutputFormatter\JsonOutputFormatter;
use ApiFormatter\Infrastructure\OutputFormatter\PdfBinaryOutputFormatter;
use ApiFormatter\Infrastructure\OutputFormatter\PlaintextOutputFormatter;

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
            default:
                throw new \Exception("Not implemented on factory yet");
        }
    }

}