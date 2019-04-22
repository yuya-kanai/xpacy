<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCountriesToSnakeCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function(Blueprint $table) {
            $table->renameColumn('countryCode','country_code');
            $table->renameColumn('countryName','country_name');
            $table->renameColumn('currencyCode','currency_code'); 
            $table->renameColumn('fipsCode','fips_code');
            $table->renameColumn('isoNumeric','iso_numeric');
            $table->renameColumn('continentName','continent_name');
            $table->renameColumn('isoAlpha3','iso_alpha3');
            $table->renameColumn('geonameID','geoname_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function(Blueprint $table) {
            $table->renameColumn('country_code', 'countryCode');
            $table->renameColumn('country_name', 'countryName');
            $table->renameColumn('currency_code', 'currencyCode'); 
            $table->renameColumn('fips_code', 'fipsCode');
            $table->renameColumn('iso_numeric', 'isoNumeric');
            $table->renameColumn('continent_name' ,'continentName');
            $table->renameColumn('iso_alpha3','isoAlpha3');
            $table->renameColumn('geoname_id','geonameID');
        });
        //
    }
}
