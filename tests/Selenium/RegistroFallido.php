<?php
require_once 'BaseSeleniumTest.php';

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class RegistroTest extends BaseSeleniumTest
{
    public function testRegistroFallido()
    {
        $this->driver->get('http://localhost:8000/register');

        $wait = new WebDriverWait($this->driver, 10);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('name'))
        )->sendKeys('Adolfo');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('email'))
        )->sendKeys('invalid-email');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('password'))
        )->sendKeys('123');
        $wait->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::cssSelector('button[type="submit"]'))
        )->click();
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.alert-danger'))
        );
        echo $this->driver->getPageSource();
    }
}