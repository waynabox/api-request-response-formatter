# Waynabox Api Formatter

A bundle of tools to handle Waynabox API request and responses.
 
### Output formatter types

##### OutputFormat::JSON_ENCODED (default value)
Use this to output a previously generated json as string on browser. It puts as header 'Content-type: json'
This option will add additional data on json response for status and error response.
```php
$data = '{"param1":"value 1","param2":"value 2"}';
return ApiResponseFactory::buildAcceptedResponse(
            $data
        )->output();
//outputs '{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{}}'
```

##### OutputFormat::PLAIN_TEXT
Use this to output a string as plain text on browser. It puts as header 'Content-type: text' 
```php
$data = 'my text';
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::PLAIN_TEXT
        )->output();
//outputs 'my text'
```
 
##### OutputFormat::JSON
Use this to output an array with data as a json encoded on browser. It puts as header 'Content-type: json'.

This option will add additional data on json response for status and error response.
```php
$data = ['param1' => 'value 1', 'param2' => 'value 2'];
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::JSON
        )->output();
//outputs '{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{}}'
```

##### OutputFormat::BINARY_PDF
Use this to output a specific PDF binary stream on browser as a direct download. It puts as header 'Content-type: application/pdf'
```php
$data = #myBinaryStream;
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::BINARY_PDF
        )->output();
//outputs a pdf file to download on browser
```


### How to create a Waynabox API Response
```php
 public function createAction(Request $request)
 {
    try {
        $serviceResponseData = $this->myService($request->request->all());
        return ApiResponseFactory::buildAcceptedResponse($serviceResponse->response())->output();
    } catch (MyAuthenticationFailedException $e) {
        return ApiResponseFactory::buildAuthenticationFailedResponse($e->getMessage())->output();
    } catch (\Exception $e) {
        return ApiResponseFactory::buildBadRequestResponse($e->getMessage())->output();
    }
    
}
```