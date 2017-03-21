<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 9/03/17
 * Time: 16:14
 */

namespace ApiFormatter\Domain\Response;

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