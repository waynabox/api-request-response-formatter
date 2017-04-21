# Waynabox Api Formatter

A bundle of tools to handle Waynabox API request and responses.
 
* [How to create a Waynabox API Response](#1)
* [API Response types](#2)
    * [Returning an accepted response (Code 200)](#2.1)
    * [Returning a created response (Code 201)](#2.2)
    * [Returning a bad request response (Code 400)](#2.3)
    * [Returning an authentication failed response (Code 401)](#2.4)
    * [Returning a not found response (Code 404)](#2.5)
    * [Returning a server error response (Code 500)](#2.6)
    
* [Output formatter types](#3)
    * [OutputFormat::JSON_STRING (default value)](#3.1)
    * [OutputFormat::HTML](#3.2)
    * [OutputFormat::PLAIN_TEXT](#3.3)
    * [OutputFormat::JSON](#3.4)
    * [OutputFormat::BINARY_PDF](#3.5)
 
### <a name="1"></a>How to create a Waynabox API Response
```php
 public function helloAction(Request $request)
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

### <a name="2"></a>API Response types

##### <a name="2.1"></a>Returning an accepted response (Code 200)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildAcceptedResponse('text on response data section');
        return $response->output();
 }
```

##### <a name="2.2"></a>Returning a created response (Code 201)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildCreatedResponse('text on response data section');
        return $response->output();
 }
```

##### <a name="2.3"></a>Returning a bad request response (Code 400)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildBadRequestResponse('text on response error section');
        return $response->output();
 }
```

##### <a name="2.4"></a>Returning an authentication failed response (Code 401)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildAuthenticationFailedResponse('text on response error section');
        return $response->output();
 }
```

##### <a name="2.5"></a>Returning a not found response (Code 404)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildNotFoundResponse('text on response error section');
        return $response->output();
 }
```

##### <a name="2.6"></a>Returning a server error response (Code 500)
```php
 public function helloAction(Request $request)
 {
        $response = ApiResponseFactory::buildServerErrorResponse('text on response error section');
        return $response->output();
 }
```

### <a name="3"></a>Output formatter types

##### <a name="3.1"></a>OutputFormat::JSON_STRING (default value)
Use this to output a previously generated json as string on browser. It puts as header 'Content-type: json'
This option will add additional data on json response for status, error response and timestamp.
```php
$data = '{"param1":"value 1","param2":"value 2"}';
return ApiResponseFactory::buildAcceptedResponse(
            $data
        )->output();
//outputs '{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{},"date":"2017-01-01 01:01:01"}'
```

##### <a name="3.2"></a>OutputFormat::HTML
Use this to output a string as plain text on browser. It puts as header 'Content-type: text/html' 
```php
$data = '<html>hello</html>';
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::HTML
        )->output();
//outputs '<html>hello</html>'
```

##### <a name="3.3"></a>OutputFormat::PLAIN_TEXT
Use this to output a string as plain text on browser. It puts as header 'Content-type: text' 
```php
$data = 'my text';
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::PLAIN_TEXT
        )->output();
//outputs 'my text'
```
 
##### <a name="3.4"></a>OutputFormat::JSON
Use this to output an array with data as a json encoded on browser. It puts as header 'Content-type: json'.

This option will add additional data on json response for status, error response and timestamp
```php
$data = ['param1' => 'value 1', 'param2' => 'value 2'];
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::JSON
        )->output();
//outputs '{"status":200,"data":{"param1":"value 1","param2":"value 2"},"error":{},"date":"2017-01-01 01:01:01"}'
```

##### <a name="3.5"></a>OutputFormat::BINARY_PDF
Use this to output a specific PDF binary stream on browser as a direct download. It puts as header 'Content-type: application/pdf'
```php
$data = #myBinaryStream;
return ApiResponseFactory::buildAcceptedResponse(
            $data,
            OutputFormat::BINARY_PDF
        )->output();
//outputs a pdf file to download on browser
```