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
    /** @var array  */
    private $data;

    /**
     * ProcessingBatchResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }
}