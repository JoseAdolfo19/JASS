
<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use PHPUnit\Framework\TestCase;

// Clase base que configura Selenium WebDriver para pruebas automatizadas con PHPUnit
class BaseSeleniumTest extends TestCase
{
    // Variable protegida para acceder al navegador
    protected $driver;

    // Método que se ejecuta antes de cada prueba
    protected function setUp(): void
    {
        // Dirección del servidor de Selenium que está corriendo en modo standalone
        $host = 'http://localhost:4444/wd/hub';

        // Indica que se usará Google Chrome como navegador
        $capabilities = DesiredCapabilities::chrome();

        // Crea una nueva sesión de navegador con las capacidades indicadas
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }

    // Método que se ejecuta después de cada prueba
    protected function tearDown(): void
    {
        // Cierra el navegador y finaliza la sesión
        $this->driver->quit();
    }
}