## TestingBot - PHPUnit Mobile Example

TestingBot provides a grid of browsers and mobile devices to run Automated tests.
This example demonstrates how to use PHP with PHPUnit, [php-webdriver](https://github.com/php-webdriver/php-webdriver) and Appium to test a mobile app on TestingBot's Android emulators and iOS simulators.

The test opens a sample calculator app, enters two numbers and checks the sum.

### Environment Setup

1. Global Dependencies
    * PHP 8.2 or newer
    * Install [Composer](https://getcomposer.org/download/)

2. Project Dependencies
    * Clone the repository
    * Install all dependencies: `composer install`

3. TestingBot Credentials
    * Add your TestingBot Key and Secret as environment variables. You can find these in the [TestingBot Dashboard](https://testingbot.com/members/).
    ```
    $ export TESTINGBOT_KEY=<your TestingBot Key>
    $ export TESTINGBOT_SECRET=<your TestingBot Secret>
    ```
    (`TB_KEY`/`TB_SECRET` work too.)

### Your app
The configs in `config/` use our sample apps. To test your own `.apk`, `.ipa` or simulator `.zip`, upload it to TestingBot Storage:
```
curl -u "$TESTINGBOT_KEY:$TESTINGBOT_SECRET" -X POST "https://api.testingbot.com/v1/storage" -F "file=@/path/to/app/file/Application.apk"
```
Then set the returned `tb://...` id as `TB_APP_ID` (or as `appium:app` in the config files):
```
export TB_APP_ID=tb://<your-app-id>
```

### Running Tests

* Android emulator: `composer android_single`
* iOS simulator: `composer ios_single`
* Two devices at the same time: `composer android_parallel` or `composer ios_parallel`

Devices are configured in `config/<platform>/*.conf.json` using W3C capabilities (`platformName`, `appium:deviceName`, `appium:platformVersion`).
Each test is marked as passed or failed on TestingBot. You will see the results in the [TestingBot Dashboard](https://testingbot.com/members/).

### Resources
##### [TestingBot PHP Appium Documentation](https://testingbot.com/support/app-automate/appium/php)

##### [PHPUnit Documentation](https://phpunit.de/documentation.html)
