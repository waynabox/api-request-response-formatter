<?php

namespace Waynabox\ApiFormatter\Domain\Response;

class ApiResponseData implements ApiResponseDataInterface
{
    /** @var mixed */
    private $data;

    /**
     * ProcessingBatchResponse constructor.
     *
     * @param mixed $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}