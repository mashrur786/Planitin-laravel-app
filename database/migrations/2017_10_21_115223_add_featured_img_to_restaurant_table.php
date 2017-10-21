<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedImgToRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::table('restaurants', function(Blueprint $table){

            $table->string('featured_img')->nullable()->after('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
           Schema::table('restaurants', function( Blueprint$table){

            $table->dropColumn('featured_img');

        });
    }
}
