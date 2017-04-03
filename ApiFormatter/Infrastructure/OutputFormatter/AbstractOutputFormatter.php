<?php

namespace Waynabox\ApiFormatter\Infrastructure\OutputFormatter;


use Symfony\Component\HttpFoundation\Response;

abstract class AbstractOutputFormatter
{
    /**
     * @param string $statusCode
     * @param string $data
     * @return Response
     */
    protected function createResponse($statusCode, $data): Response
    {
        $response = new Response();
        $response->headers->add([
            'content-type' => $this->getContentType()
        ]);
        if (!is_null($statusCode)) {
            $response->setStatusCode($statusCode);
        }
        $response->setContent($data);
        return $response;
    }

    /**
     * @return string
     */
    abstract protected function getContentType(): string;
}