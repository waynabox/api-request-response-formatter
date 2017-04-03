<?php

namespace vApiFormatter\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class PlaintextOutputFormatter extends AbstractOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
    {
        return $this->createResponse($request->statusCode(), $request->output());
    }

    /**
     * @return string
     */
    protected function getContentType(): string
    {
        return 'plain/text';
    }
}