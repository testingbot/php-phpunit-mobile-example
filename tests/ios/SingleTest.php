<?php

use Facebook\WebDriver\WebDriverExpectedCondition;

class SingleTest extends TestingBotTestCase
{
    public function testSumOfTwoNumbers(): void
    {
        $wait = $this->driver->wait(30);

        // On iOS the accessibility id also matches the label next to each field,
        // so select the text fields explicitly.
        $inputA = $wait->until(WebDriverExpectedCondition::presenceOfElementLocated(
            AppiumBy::iOSPredicate("name == 'inputA' AND type == 'XCUIElementTypeTextField'")
        ));
        $inputA->clear(); // the field starts with "0"
        $inputA->sendKeys('10');

        $inputB = $this->driver->findElement(AppiumBy::iOSPredicate("name == 'inputB' AND type == 'XCUIElementTypeTextField'"));
        $inputB->clear();
        $inputB->sendKeys('5');

        $sum = $this->driver->findElement(AppiumBy::iOSPredicate("name == 'sum' AND type == 'XCUIElementTypeTextField'"));
        $wait->until(fn () => $sum->getText() === '15');
        $this->assertSame('15', $sum->getText());
    }
}
