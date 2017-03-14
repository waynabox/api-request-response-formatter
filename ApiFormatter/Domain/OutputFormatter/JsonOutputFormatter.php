<?php

namespace ApiFormatter\Domain\OutputFormatter;

use Symfony\Component\HttpFoundation\Response;

class JsonOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return Response
     */
    public function format(OutputFormatterRequest $request): Response
    {
        $jsonResponse = new Response();
        $jsonResponse->headers->add([
            'content-type' => 'json'
        ]);
        $jsonResponse->setStatusCode($request->statusCode());
        $jsonResponse->setContent($request->output());

        return $jsonResponse->send();
    }
}