<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
use Doctrine\DBAL\Driver\OCI8\Driver;

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
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start crawling!!');
        $host = 'http://localhost:4444/wd/hub';
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize();
        $this->driver->get('https://www.tripadvisor.com/Restaurants');
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
    private function clickWithXpath(String $xpath)
    {
        $xpath_web = WebDriverBy::xpath(
            $xpath
        );

        if (count($this->driver->findElements($xpath_web)) > 0) {
            $element = $this->driver->findElement(
                WebDriverBy::xpath(
                    $xpath
                )
            );
            $element->click();
            $current_handle = $this->driver->getWindowHandles();
            echo("Current : ".count($current_handle)."\r\n");
        } else {
        }
    }

    private function getWithXpath( String $attribute ,String $xpath)
    {
        $xpath_web = WebDriverBy::xpath(
            $xpath
        );
        if (count($this->driver->findElements($xpath_web)) > 0) {
            $element = $this->driver->findElement(
                WebDriverBy::xpath(
                    $xpath
                )
            );
            if($attribute == 'text'){
                return $element->getText();
            }else{
                return $element->getAttribute($attribute);
            }
        }
        return null;
    }

    private function selenium()
    {
        $search_box = $this->driver->findElement(WebDriverBy::cssSelector('.typeahead_input'));
        $search_box->sendKeys('Chiang Mai');

        $submit_button = $this->driver->findElement(WebDriverBy::cssSelector('#SUBMIT_RESTAURANTS'));
        $submit_button->click();

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::titleContains('BEST Restaurants')
        );

        $restaurant_checkbox = "//div[@id='jfy_filter_bar_establishmentTypeFilters']/div[2]/div/div/a";
        $cheap = "//div[@id='jfy_filter_bar_price']/div[2]/div[1]/div";
        $midrange = "//div[@id='jfy_filter_bar_price']/div[2]/div[1]/div";

        $this->clickWithXpath($restaurant_checkbox);
        
        $this->clickWithXpath($cheap);
        $this->clickWithXpath($midrange);


        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                WebDriverBy::xpath(
                    "//div[5]/div/a/div/img"
                )
            )
        );
        $this->driver->manage()->timeouts()->implicitlyWait(0.5);
        for ($i = 1; $i <= 20; $i++) {
            $this->clickWithXpath("//div[".$i."]/div/a/div/img");
        }
        
        $current_handle = $this->driver->getWindowHandles();
        $tabs = array_slice($current_handle, 1);
        foreach ($tabs as &$tab) {
            $this->driver->switchTo()->window($tab);
            $name_xpath="//div[contains(@class,'restaurantName')]/h1";
            $price_xpath="//div[contains(@class,'restaurants-detail-overview-cards-DetailsSectionOverviewCard__detailCard')]/div[2]/div/div[2]";
            $price_label_xpath="//div[contains(@class,'restaurants-detail-overview-cards-DetailsSectionOverviewCard__detailCard')]/div[2]/div/div";
            $map_xpath= "//div[contains(@class,'restaurants-detail-overview-cards-LocationOverviewCard__cardColumn')]/span/div/span/img";
            $website_xpath= "//div[contains(@class,'restaurants-detail-overview-cards-LocationOverviewCard__detailLink')]/span/div/a";
            $image_xpath = "//div[contains(@class,'photos_and_contact_links_container')]/div/div[2]/div[2]/div/div/img";


            $name=null;
            $price=null;
            $coordinates=[];

            if (count($this->driver->findElements($xpath_web)) > 0) {
                $price_label = $this->getWithXpath('text',$price_label_xpath);
                if(preg_match("/price/i",$price_label)){

                    $map_url = $this->getWithXpath('src',$map_xpath);
                    preg_match('/(\.|\d)*,(\.|\d)*\z/', $map_url, $coordinates_string_array);
                    $coordinates_string = $coordinates_string_array[0];
                    $coordinates = explode(',',$coordinates_string);

                    $price = $this->getWithXpath('text',$price_xpath);
                    $name = $this->getWithXpath('text',$name_xpath);
                    $trip_advisor_url = $this->driver->getCurrentURL();
                    $website_url = $this->getWithXpath('href',$website_xpath);
                    $image_url = $this->getWithXpath('src',$image_xpath);
                }
            }
        }
    }
}
