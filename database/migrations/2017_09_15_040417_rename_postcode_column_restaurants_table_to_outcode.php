<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePostcodeColumnRestaurantsTableToOutcode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('restaurants', function(Blueprint $table) {
                        $table->renameColumn('postcode', 'outcode');
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
        Schema::table('restaurants', function(Blueprint $table) {
                        $table->renameColumn('outcode', 'postcode');
                });
    }
}
