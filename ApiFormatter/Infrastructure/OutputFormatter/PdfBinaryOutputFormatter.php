<?php

namespace Waynabox\ApiFormatter\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class PdfBinaryOutputFormatter extends AbstractOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
    {
        return $this->createResponse(
            $request->statusCode(),
            (string)$request->output()
        );
    }

    /**
     * @return string
     */
    protected function getContentType(): string
    {
        return 'application/pdf';
    }
}