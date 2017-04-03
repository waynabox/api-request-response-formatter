<?php

namespace Waynabox\ApiFormatter\Infrastructure\OutputFormatter;

use Symfony\Component\HttpFoundation\Response;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class JsonEncodedOutputFormatter extends AbstractOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return Response
     */
    public function format(OutputFormatterRequest $request): Response
    {
        $data = $this->prepareData($request);
        return $this->createResponse($request->statusCode(), $data);
    }

    /**
     * @param OutputFormatterRequest $request
     * @return string
     */
    private function prepareData(OutputFormatterRequest $request): string
    {
        $output = $request->output();
        if (empty($output)) {
            $output = '{}';
        }
        $jsonResponse = [];
        $jsonResponse['status'] = $request->statusCode();
        $jsonResponse['data'] = json_decode($output);
        $jsonResponse['error'] = $request->error();
        return json_encode($jsonResponse);
    }

    /**
     * @return string
     */
    protected function getContentType(): string
    {
        return 'application/json';
    }
}