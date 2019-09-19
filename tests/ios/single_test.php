<?php
    require 'vendor/autoload.php';

    class SingleTest extends TestingBotTest {

        public function testMyApp() {
            $el = $this->byAccessibilityId('inputA');
			$el->click();
			$this->keys("10");
			$el = $this->byAccessibilityId('inputB');
			$el->click();
			$this->keys("5");
			$this->assertInstanceOf('PHPUnit_Extensions_AppiumTestCase_Element', $el);
        }
    }

?>