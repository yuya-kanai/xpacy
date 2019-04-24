<?php

use Illuminate\Database\Seeder;

include 'list.php';
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class CountriesTableSeeder extends Seeder
{
    const CSV_FILENAME = '/database/seeds/countryList.csv';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // addCountries();
        $this->fillCountryCodes();
    }

    private function fillCountryCodes()
    {
        DB::table('countries')->delete();
        // $path = 'app/countries.sql';
        // DB::unprepared(file_get_contents($path));
        // App\Country::create( [
        //     'country_code'=>'AD',
        //     'country_name'=>'Andorra',
        // ] );
        $this->command->info('Importing csv');

        $config = new LexerConfig();
        $config->setDelimiter(',');
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function (array $row) {
            $country_code   = $row[1];
            $country_name   = $row[2];
            $currency_code  = $row[3];
            $fips_code      = $row[4];
            $iso_numeric    = $row[5];
            $north          = $row[6];
            $south          = $row[7];
            $east           = $row[8];
            $west           = $row[9];
            $capital        = $row[10];
            $continent_name = $row[11];
            $continent      = $row[12];
            $languages      = $row[13];
            $iso_alpha3     = $row[14];
            $geoname_id     = $row[15];

            App\Country::create([
                'country_code'   => $country_code,
                'country_name'   => $country_name,
                'currency_code'  => $currency_code,
                'fips_code'      => $fips_code,
                'iso_numeric'    => $iso_numeric,
                'north'          => $north,
                'south'          => $south,
                'east'           => $east,
                'west'           => $west,
                'capital'        => $capital,
                'continent_name' => $continent_name,
                'continent'      => $continent,
                'languages'      => $languages,
                'iso_alpha3'     => $iso_alpha3,
                'geoname_id'     => $geoname_id,
            ]);
        });

        $lexer->parse(base_path() . self::CSV_FILENAME, $interpreter);
    }
}
