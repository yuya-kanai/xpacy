<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $crawler = \Goutte::request('GET', 'https://duckduckgo.com/html/?q=Laravel');
        $crawler->filter('.result__title .result__a')->each(function ($node) {
           dump($node->text());
        });
        //
    }
}
