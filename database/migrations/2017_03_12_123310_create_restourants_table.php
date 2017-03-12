<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestourantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('Business_name');
            $table->text('description')->nullable();
            $table->string('cuisine', 20);
            $table->string('Business_phone1');
            $table->string('Business_phone2')->nullable();
            $table->string('address');
            $table->string('street');
            $table->string('town');
            $table->string('county');
            $table->string('postcode' , 10);
            $table->text('website')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
