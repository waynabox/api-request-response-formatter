<?php

namespace ApiFormatter\Infrastructure\OutputFormatter;

use ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class PdfBinaryOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
    {
        header('Content-type: application/pdf');
        return (string) $request->output();
    }
}

    {

    }