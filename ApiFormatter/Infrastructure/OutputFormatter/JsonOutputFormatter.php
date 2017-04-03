<?php

namespace Waynabox\ApiFormatter\Infrastructure\OutputFormatter;

use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use Waynabox\ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class JsonOutputFormatter extends AbstractOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
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
        $jsonResponse = [];
        $jsonResponse['status'] = $request->statusCode();
        $jsonResponse['data'] = $request->output();
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