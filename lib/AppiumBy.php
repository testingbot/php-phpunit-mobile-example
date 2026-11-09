<?php

use Facebook\WebDriver\WebDriverBy;

/**
 * php-webdriver has no factories for Appium's locator strategies.
 * WebDriverBy's constructor is protected and the class is not final, so add them here.
 */
class AppiumBy extends WebDriverBy
{
    public static function accessibilityId(string $value): self
    {
        return new static('accessibility id', $value);
    }

    public static function iOSPredicate(string $value): self
    {
        return new static('-ios predicate string', $value);
    }
}
