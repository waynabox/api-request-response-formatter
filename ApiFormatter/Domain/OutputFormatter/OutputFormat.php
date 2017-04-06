<?php

namespace Waynabox\ApiFormatter\Domain\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\Exception\FormatTypeNotAllowedException;

class OutputFormat
{
    const PLAIN_TEXT = 1;
    const JSON = 2;
    const BINARY_PDF = 3;
    const JSON_ENCODED = 4;
    const HTML = 5;

    const ALLOWED = [
        self::PLAIN_TEXT,
        self::JSON,
        self::BINARY_PDF,
        self::JSON_ENCODED,
        self::HTML
    ];

    /**
     * @var int
     */
    private $type;

    /**
     * OutputFormat constructor.
     * @param int $type
     */
    private function __construct($type)
    {
        $this->setType($type);
    }

    /**
     * @param int $type
     * @throws FormatTypeNotAllowedException
     */
    private function setType(int $type)
    {
        if (!in_array($type, self::ALLOWED)) {
            throw new FormatTypeNotAllowedException($type);
        }
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function type(): int
    {
        return $this->type;
    }



    /**
     * @param $type
     * @return OutputFormat
     */
    public static function build($type)
    {
        return new self($type);
    }
}