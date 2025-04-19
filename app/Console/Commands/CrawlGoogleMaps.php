<?php

namespace App\Console\Commands;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Illuminate\Console\Command;

class CrawlGoogleMaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:maps';
    protected $description = 'Crawl dữ liệu từ Google Maps';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();

        $driver = RemoteWebDriver::create($host, $capabilities);

        $driver->get('https://www.google.com');
        $this->info('Tiêu đề trang: ' . $driver->getTitle());

        $driver->quit();
    }
}
