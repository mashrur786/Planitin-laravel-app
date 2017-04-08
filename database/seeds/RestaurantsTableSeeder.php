<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('App\Restaurant');

        foreach(range(1,50) as $x) {

            DB::table('Restaurants')->insert([

                'email' => $faker->unique()->email,
                'business_name' => $faker->company,
                'description' => $faker->sentence(10),
                'cuisine' => $faker->word,
                'business_phone1' => $faker->e164PhoneNumber,
                'business_phone2' => $faker->e164PhoneNumber,
                'address' => $faker->secondaryAddress,
                'street' => $faker->streetName,
                'town' => $faker->city,
                'county' => $faker->state,
                'postcode' => $faker->postcode,
                'website' => $faker->safeEmailDomain,
                'contact_name' => $faker->name,
                'contact_phone' => $faker->e164PhoneNumber,
            ]);

        }
    }
}
