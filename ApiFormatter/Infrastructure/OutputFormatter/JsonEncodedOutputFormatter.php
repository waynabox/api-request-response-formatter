<?php

namespace ApiFormatter\Infrastructure\OutputFormatter;

use ApiFormatter\Domain\OutputFormatter\OutputFormatterInterface;
use ApiFormatter\Domain\OutputFormatter\OutputFormatterRequest;

class JsonEncodedOutputFormatter implements OutputFormatterInterface
{
    /**
     * @param OutputFormatterRequest $request
     *
     * @return string
     */
    public function format(OutputFormatterRequest $request): string
    {

        $data = $request->additionalData();
        $jsonResponse = [];
        $jsonResponse['status'] = $data['status'];
        $jsonResponse['data'] = json_decode($request->output());
        $jsonResponse['error'] = $data['error'];

        header('Content-type: json');
        return json_encode($jsonResponse);
    }
}
{

}