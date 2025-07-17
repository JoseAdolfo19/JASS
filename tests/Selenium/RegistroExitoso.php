<?php
require_once 'BaseSeleniumTest.php';

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class RegistroTest extends BaseSeleniumTest
{
    public function testRegistroExitoso()
    {
        $this->driver->get('http://localhost:8000/register');

        $wait = new WebDriverWait($this->driver, 10);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('name'))
        )->sendKeys('Adolfo');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('email'))
        )->sendKeys('adolfo@gmail.com');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('password'))
        )->sendKeys('123456789');
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::name('password_confirmation'))
        )->sendKeys('123456789');
        $wait->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::cssSelector('button[type="submit"]'))
        )->click();
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.alert-success'))
        );
        echo $this->driver->getPageSource();
    }
}