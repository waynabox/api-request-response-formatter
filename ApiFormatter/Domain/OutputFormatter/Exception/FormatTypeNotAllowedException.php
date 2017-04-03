<?php

namespace ApiFormatter\Domain\OutputFormatter\Exception;

class FormatTypeNotAllowedException extends \Exception
{
    /**
     * FormatTypeNotAllowedException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $message = sprintf("Output format type %s is not allowed", $message);
        parent::__construct($message, $code, $previous);
    }
}