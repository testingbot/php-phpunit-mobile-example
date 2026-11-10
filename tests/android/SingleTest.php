<?php

use Facebook\WebDriver\WebDriverExpectedCondition;

class SingleTest extends TestingBotTestCase
{
    public function testSumOfTwoNumbers(): void
    {
        $wait = $this->driver->wait(30);

        $wait->until(WebDriverExpectedCondition::presenceOfElementLocated(AppiumBy::accessibilityId('inputA')))
            ->sendKeys('10');
        $this->driver->findElement(AppiumBy::accessibilityId('inputB'))->sendKeys('5');

        $sum = $this->driver->findElement(AppiumBy::accessibilityId('sum'));
        $wait->until(fn () => $sum->getText() === '15');
        $this->assertSame('15', $sum->getText());
    }
}
