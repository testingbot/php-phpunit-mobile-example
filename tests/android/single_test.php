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

			$sum = $this->byAccessibilityId('sum')->text();
			$this->assertEquals($sum, "15");
        }
    }

?>