<?php
require_once 'BaseSeleniumTest.php';

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class LoginTest extends BaseSeleniumTest
{
    public function testLoginExitoso()
    {
        $this->driver->get('http://localhost:8000/login');

        $wait = new WebDriverWait($this->driver, 10);
        
        // Wait for email field and send keys
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('email'))
        )->sendKeys('adolfo@gmail.com');

        // Wait for password field and send keys
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('password'))
        )->sendKeys('123456789');

        echo $this->driver->getPageSource();
    }
}