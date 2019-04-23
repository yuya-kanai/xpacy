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

    private function selenium(){
        // selenium
        $host = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create($host,DesiredCapabilities::chrome());
        $driver->manage()->window()->maximize();
        $driver->get('https://www.tripadvisor.com/Restaurants');
        $element = $driver->findElement(WebDriverBy::name('q'));
        // 検索Boxにキーワードを入力して
        $element->sendKeys('セレニウムで自動操作');
        // 検索実行
        $element->submit();
    
        // 検索結果画面のタイトルが 'セレニウムで自動操作 - Google 検索' になるまで10秒間待機する
        // 指定したタイトルにならずに10秒以上経ったら
        // 'Facebook\WebDriver\Exception\TimeOutException' がthrowされる
        $driver->wait(10)->until(
            WebDriverExpectedCondition::titleIs('セレニウムで自動操作 - Google 検索')
        );
    
        // セレニウムで自動操作 - Google 検索 というタイトルを取得できることを確認する
        if ($driver->getTitle() !== 'セレニウムで自動操作 - Google 検索') {
            throw new Exception('fail');
        }
    }
}
