# Waynabox Api Formatter

A bundle of tools to handle Waynabox API request and responses. 

### How to create a Waynabox API Response
```php
 public function createAction(Request $request)
 {
    try {
        $serviceResponseData = $this->myService($request->request->all());
        return $this->sendResponse(ApiResponseFactory::buildAcceptedResponse($serviceResponseData));
    } catch (MyAuthenticationFailedException $e) {
        return $this->sendResponse(ApiResponseFactory::buildAuthenticationFailedResponse($e->getMessage()));
    } catch (\Exception $e) {
        return $this->sendResponse(ApiResponseFactory::buildBadRequestResponse($e->getMessage()));
    }
}
```