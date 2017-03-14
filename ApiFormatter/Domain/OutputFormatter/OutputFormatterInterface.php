<?php

namespace ApiFormatter\Domain\OutputFormatter;

interface OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return mixed
     */
    public function format(OutputFormatterRequest $request);
}