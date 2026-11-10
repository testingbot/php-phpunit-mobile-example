<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\TestCase;

/**
 * Starts an Appium session on TestingBot for every test, using the device
 * from the config file (CONFIG_FILE) at index TASK_ID, and reports the
 * test result to TestingBot afterwards.
 */
abstract class TestingBotTestCase extends TestCase
{
    protected RemoteWebDriver $driver;

    protected function setUp(): void
    {
        $configFile = getenv('CONFIG_FILE') ?: 'config/android/single.conf.json';
        $config = json_decode(file_get_contents($configFile), true, 512, JSON_THROW_ON_ERROR);
        $taskId = (int) (getenv('TASK_ID') ?: 0);

        $caps = array_merge($config['capabilities'], $config['environments'][$taskId]);

        $app = getenv('TB_APP_ID');
        if ($app) {
            $caps['appium:app'] = $app;
        }

        $caps['tb:options'] = array_merge($caps['tb:options'] ?? [], [
            'key' => getenv('TESTINGBOT_KEY') ?: getenv('TB_KEY'),
            'secret' => getenv('TESTINGBOT_SECRET') ?: getenv('TB_SECRET'),
            'name' => $this->name(),
        ]);

        $this->driver = RemoteWebDriver::create(
            'https://hub.testingbot.com/wd/hub',
            new DesiredCapabilities($caps),
            120000,
            300000
        );
    }

    protected function tearDown(): void
    {
        if (!isset($this->driver)) {
            return;
        }
        try {
            $passed = $this->status()->isSuccess();
            $this->driver->executeScript('tb:test-result=' . ($passed ? 'passed' : 'failed'));
        } finally {
            $this->driver->quit();
        }
    }
}
