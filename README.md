Steps to run:

* composer install
* php bin/console server:start
* open browser http://127.0.0.1:8000/
* To run the tests from console: ./bin/phpunit

@Todo:

* Improve file data read - use parameter for the file folder path
* User and Venue files can contain no entries - handle this
* Use some separate classes to read the data from json files so it can be reused.
* Improve error handling - separate classes for exceptions, error reporting ?
* Refactor getPlacesGoAvoid(), so that the response is more clear and don't use array keys - make it consistent