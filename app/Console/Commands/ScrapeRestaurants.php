<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

class ScrapeRestaurants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:restaurants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape from trip advisor';
    private $driver;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $host = 'http://localhost:4444/wd/hub';
        $this->driver = RemoteWebDriver::create($host,DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize();
        $this->driver->get('https://www.tripadvisor.com/Restaurants');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start crawling!!');
        $this->selenium();
        // $crawler = \Goutte::request('GET', 'https://duckduckgo.com/html/?q=Laravel');
        // $crawler->filter('.result__title .result__a')->each(function ($node) {
        //     \App\Food::create([
        //         'name'   => $node->text()
        //     ]);
        //    dump($node->text());
        // });
        //
    }
    private function clickWithXpath(String $xpath){
        $xpath_web = WebDriverBy::xpath(
            $xpath
        );

        if( count($this->driver->findElements($xpath_web)) > 0 ) {
            $element = $this->driver->findElement(
                WebDriverBy::xpath(
                    $xpath
                )
            );
            $element->click();
        }else{
            echo('Not available : '.$xpath.'¥n');
        }
     
    }


    private function selenium(){
        // selenium
        $element = $this->driver->findElement(WebDriverBy::cssSelector('.typeahead_input'));
        // 検索Boxにキーワードを入力して
        $element->sendKeys('Chiang Mai');
        // 検索実行

        $element = $this->driver->findElement(WebDriverBy::cssSelector('#SUBMIT_RESTAURANTS'));
        $element->click(); 

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::titleContains('BEST Restaurants')
        );

        $this->clickWithXpath(
            "//div[@id='jfy_filter_bar_establishmentTypeFilters']/div[2]/div/div/a"
        ); 
        $this->clickWithXpath(
            "//div[@id='jfy_filter_bar_price']/div[2]/div[1]/div"
        );
        $this->clickWithXpath(
            "//div[@id='jfy_filter_bar_price']/div[2]/div[2]/div"
        );


        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                WebDriverBy::xpath(
                    "//div[5]/div/a/div/img"
                )
            )
        );
        for ($i = 1; $i <= 30; $i++) {
            $this->clickWithXpath("//div[".$i."]/div/a/div/img");
        }
                
    }
}
