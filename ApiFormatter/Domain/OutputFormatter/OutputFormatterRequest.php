<?php

namespace ApiFormatter\Domain\OutputFormatter;

class OutputFormatterRequest
{
    /** @var mixed */
    private $output;

    /** @var mixed */
    private $additionalData;

    /**
     * OutputFormatterRequest constructor.
     * @param mixed $output
     * @param mixed $additionalData
     */
    public function __construct($output, $additionalData = array())
    {
        $this->output = $output;
        $this->additionalData = $additionalData;
    }

    /**
     * @return mixed
     */
    public function output()
    {
        return $this->output;
    }

    /**
     * @return mixed
     */
    public function additionalData()
    {
        return $this->additionalData;
    }
}