<?php
require_once 'BaseSeleniumTest.php';

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class LoginTest extends BaseSeleniumTest
{
    public function testLoginFallido()
    {
        $this->driver->get('http://localhost:8000/login');

        $wait = new WebDriverWait($this->driver, 10);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('email'))
        )->sendKeys('adolfo@gmail.com');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('password'))
        )->sendKeys('contraseñaIncorrecta');
        $wait->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::cssSelector('button[type="submit"]'))
        )->click();
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.alert-danger'))
        );
        echo $this->driver->getPageSource();
    }
}