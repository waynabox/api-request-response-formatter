<?php

namespace Waynabox\ApiFormatter\Tests\Domain\Response;

use Waynabox\ApiFormatter\Domain\Response\ApiResponseDataInterface;

class ApiResponseDataMock implements ApiResponseDataInterface
{
    private $param1;
    private $param2;
    private $paramN;

    public function __construct($param1, $param2, $paramN)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->paramN = $paramN;
    }

    public function data(): array
    {
        return [
            'param1' => $this->param1,
            'param2' => $this->param2,
            'paramN' => $this->paramN,
        ];
    }
}