<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fillCountryCodes();
    }

    private function fillCountryCodes()
    {
        
        DB::table('countries')->delete();
        $path = 'app/countries.sql';
        DB::unprepared(file_get_contents($path));

    }
}
