<?php

namespace ApiFormatter\Infrastructure\OutputFormatter;

use ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class PlaintextOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
    {
        header('Content-type: text');
        return $request->output();
    }
}
{

}