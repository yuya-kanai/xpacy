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
        // $this->call(CountriesTableSeeder::class);
        //

        $path = 'app/countries.sql';
        DB::unprepared(file_get_contents($path));

       // DB::table('countries')->insert([
       //     'id' => null,
       //     'country_name' => 'Japan',
       //     'country_code' => 'JP'
       // ]);
    }



}
