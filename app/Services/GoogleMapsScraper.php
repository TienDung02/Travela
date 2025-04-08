<?php

namespace App\Services;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class GoogleMapsScraper
{
    protected $driver;

    public function __construct()
    {
        $host = 'http://localhost:9515'; // ChromeDriver đang chạy
        $capabilities = DesiredCapabilities::chrome();
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }

    public function getPlaceInfo($query)
    {
        $this->driver->get("https://www.google.com/maps");
        sleep(2);

        // Tìm ô search
        $searchBox = $this->driver->findElement(WebDriverBy::cssSelector("input[aria-label='Search Google Maps']"));
        $searchBox->sendKeys($query);
        $searchBox->submit();

        sleep(5); // đợi kết quả load

        // Lấy thông tin (VD: tên địa điểm)
        $name = $this->driver->findElement(WebDriverBy::cssSelector('h1[class*=fontHeadlineLarge]'))->getText();

        // Tắt trình duyệt
        $this->driver->quit();

        return [
            'name' => $name,
            // bạn có thể tiếp tục lấy rating, địa chỉ, reviews,...
        ];
    }
}
