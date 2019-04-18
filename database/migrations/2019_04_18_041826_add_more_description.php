<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function($table) {
            $table->dropColumn('country_name');
            $table->string('countryName')->unique();
            $table->dropColumn('country_code');
            $table->string('countryCode');
            $table->string('currencyCode');
            $table->string('fipsCode');
            $table->string('isoNumeric');
            $table->string('north');
            $table->string('south');
            $table->string('east');
            $table->string('west'); 
            $table->string('capital'); 
            $table->string('continentName'); 
            $table->string('continent');
            $table->string('languages');
            $table->string('isoAlpha3');
            $table->string('geonameId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function($table) {
            $table->dropColumn('countryName');
            $table->dropColumn('countryCode');
            $table->dropColumn('currencyCode');
            $table->dropColumn('fipsCode');
            $table->dropColumn('isoNumeric');
            $table->dropColumn('north');
            $table->dropColumn('south');
            $table->dropColumn('east');
            $table->dropColumn('west'); 
            $table->dropColumn('capital'); 
            $table->dropColumn('continentName'); 
            $table->dropColumn('continent');
            $table->dropColumn('languages');
            $table->dropColumn('isoAlpha3');
            $table->dropColumn('geonameId');
        });
    }
}
