<?php

namespace ApiFormatter\Domain\OutputFormatter;

class OutputFormatterRequest
{
    /** @var string  */
    private $statusCode;

    /** @var mixed  */
    private $output;

    /**
     * JsonOutputFormatterRequest constructor.
     *
     * @param string $statusCode
     * @param mixed $output
     */
    public function __construct(string $statusCode, $output)
    {
        $this->statusCode = $statusCode;
        $this->output = $output;
    }

    /**
     * @return string
     */
    public function statusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function output()
    {
        return $this->output;
    }


}