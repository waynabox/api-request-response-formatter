# Changes in Waynabox Api Formatter 1.x.x

## [1.3.0]
* OK/KO on status field for responses

## [1.2.2]
* New response types: Server Error (500)

## [1.2.1]
* JSON_ENCODED constant renamed to JSON_STRING to a better understanding
* New response types: Not Found (404) and Created (201)

## [1.1.7]
* Minor fixes

## [1.1.6]
* New Output format (html)

## [1.1.5]
* bad casting getting response bug

## [1.1.4]
* unit test fixing

## [1.1.3]
* Symfony responses on Infrastructure layer

## [1.1.2]
* fixes and unit testing

## [1.1.1]
* Readme updated to comment new specifications and how-to
* Accurated code comments
* new output format type (json encoded) and specified as default value
* Added Waynabox initial namespace

## [1.1.0]
* Agnostic output formatter removing use of symfony components
* Output formatter behaviour integrated on ApiResponse Class
* Improving layer architecture separating domain logic and infrastructure logic
* Some unit testing improved with mocking
* 3 types of output, plain text, json, pdf

## [1.0.7]
* Return in field error empty jsonObject

## [1.0.6]
* Return in field error empty jsonObject

## [1.0.5]
* Allow multiple response types on response factory

## [1.0.4]
* Allow multiple response types (array, string)

## [1.0.3]
* Json output formatter for API responses

## [1.0.2]
* Added a Factory and a Generic ApiResponse to avoid DRY anti-pattern from code clients.
 
* New documentation