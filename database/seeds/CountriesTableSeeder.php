<?php

use Illuminate\Database\Seeder;
include 'list.php';
class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        addCountries();
        // $this->fillCountryCodes();
    }

    private function fillCountryCodes()
    {
        
        DB::table('countries')->delete();
        $path = 'app/countries.sql';
        // DB::unprepared(file_get_contents($path));
        App\Country::create( [
            'country_code'=>'AD',
            'country_name'=>'Andorra',
        ] );
                
    } 

}

    