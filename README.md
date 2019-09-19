[![Build Status](https://travis-ci.org/testingbot/php-phpunit-mobile-example.svg?branch=master)](https://travis-ci.org/testingbot/php-phpunit-mobile-example)

## TestingBot - PHPUnit Mobile Example

TestingBot provides a grid of browsers and mobile devices to run Automated tests.
This example demonstrates how to use PHP with PHPUnit to run tests on Real Mobile Devices.

### Environment Setup

1. Global Dependencies
    * Install [Composer](https://getcomposer.org/download/)

2. Project Dependencies
    * Clone the repository
	* Install all dependencies `composer install`

3. TestingBot Credentials
    * Add your TestingBot Key and Secret as environmental variables. You can find these in the [TestingBot Dashboard](https://testingbot.com/members/).
    ```
    $ export TB_KEY=<your TestingBot Key>
    $ export TB_SECRET=<your TestingBot Secret>
    ```

### Uploading your App
To start testing your .apk or .ipa mobile app, please upload it to TestingBot Storage:
 ```
  curl -u "key:secret" -X POST "https://api.testingbot.com/v1/storage" -F "file=@/path/to/app/file/Application.ipa"
  ```

You will receive a unique hash which you can use in the desired 'app' capability of your tests.

### Running Tests

* To run a single test, run `composer ios_single`
* To run parallel tests, run `composer android_parallel`

You will see the test result in the [TestingBot Dashboard](https://testingbot.com/members/)

### Resources
##### [TestingBot Documentation](https://testingbot.com/support/mobile/php.html)

##### [SeleniumHQ Documentation](http://www.seleniumhq.org/docs/)

##### [PHPUnit Documentation](https://phpunit.de/documentation.html)
