<?php

require 'vendor/autoload.php';
require 'lib/globals.php';
require_once('PHPUnit/Extensions/AppiumTestCase.php');
require_once('PHPUnit/Extensions/AppiumTestCase/Element.php');

class TestingBotTest extends \PHPUnit_Extensions_AppiumTestCase
{
    public static $browsers = array(array( 'browserName' => '', 'desiredCapabilities' => array()));

    public function setupSpecificBrowser($params)
    {
        $CONFIG = $GLOBALS['CONFIG'];
        $task_id = getenv('TASK_ID') ? getenv('TASK_ID') : 0;

        $host = $GLOBALS['TB_KEY'] . ":" . $GLOBALS['TB_SECRET'] . "@hub.testingbot.com";

        $this->setPort(443);
        $caps = $this->getDesiredCapabilities();
        $this->setHost($host);
        $caps = isset($params['desiredCapabilities']) ? $params['desiredCapabilities'] : array();
        $this->setDesiredCapabilities($caps);
        $this->setUpSessionStrategy($params);
    }
}

foreach($GLOBALS['CONFIG']['capabilities'] as $key => $value) {
    TestingBotTest::$browsers[0]['desiredCapabilities'][$key] = $value;
}
foreach($GLOBALS['CONFIG']['environments'][getenv('TASK_ID')] as $key => $value) {
    TestingBotTest::$browsers[0]['desiredCapabilities'][$key] = $value;
}
?>
