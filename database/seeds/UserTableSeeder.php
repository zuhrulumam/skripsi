<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash as Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        $limit = 200;
        
        for($i = 0; $i < $limit; $i++){
           DB::table("users")->insert([
               'name'=> $faker->name,
               'email'=>$faker->unique()->email,
               'password' => Hash::make("secret") ,
           ]);
        }
    }
}
