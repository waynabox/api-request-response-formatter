<?php

namespace Waynabox\ApiFormatter\Domain\OutputFormatter;

class OutputFormatterRequest
{
    /** @var mixed */
    private $output;

    /** @var string */
    private $status;

    /** @var mixed */
    private $statusCode;

    /** @var  mixed */
    private $error;

    /**
     * OutputFormatterRequest constructor.
     * @param mixed $output
     * @param string $status
     * @param mixed $statusCode
     * @param mixed $error
     */
    public function __construct($output, $status = null, $statusCode = null, $error = null)
    {
        $this->output = $output;
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->status = $status;
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
    public function error()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function statusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}