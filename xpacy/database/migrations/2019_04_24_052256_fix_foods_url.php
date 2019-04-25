<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixFoodsUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->renameColumn('url', 'trip_advisor_url');
            $table->renameColumn('restaurant_url' , 'homepage_url');
            $table->renameColumn('picture_url' , 'image_url');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->renameColumn('trip_advisor_url', 'url');
            $table->renameColumn('homepage_url', 'restaurant_url');
            $table->renameColumn('image_url', 'picture_url' );
        });
    }
}
