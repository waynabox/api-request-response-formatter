<?php

namespace Waynabox\ApiFormatter\Infrastructure\OutputFormatter;

use Symfony\Component\HttpFoundation\Response;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class PdfBinaryOutputFormatter extends AbstractOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return Response
     */
    public function format(OutputFormatterRequest $request): Response
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