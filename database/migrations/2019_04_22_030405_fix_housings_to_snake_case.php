<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixHousingsToSnakeCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('housings', function(Blueprint $table) {
            $table->renameColumn('ID','id'); 
            $table->renameColumn('countryID','country_id'); 
            $table->renameColumn('pictureURL','picture_url');
            $table->renameColumn('URL','url');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('housings', function(Blueprint $table) {
            $table->renameColumn('id','ID'); 
            $table->renameColumn('country_id','countryID'); 
            $table->renameColumn('picture_url','pictureURL');
            $table->renameColumn('url','URL');
        });
        //
    }
}
