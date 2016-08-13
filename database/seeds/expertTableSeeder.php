<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as Hash;

class expertTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("experts")->insert([
            [
                'name' => "Pak budi legowo",
                'email' => "legowo@lpp.uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak Herry purwanto ",
                'email' => "hery_p@uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak artono ",
                'email' => "adsutomo@yahoo.com",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak mulyadi",
                'email' => "mulyadi@uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak taufik lilo adi",
                'email' => "taufiqlilo@fkip.uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Daru wahyuningsih",
                'email' => "ketibandaru@yahoo.com",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Triana rejekiningsi ",
                'email' => "triana@fkip.uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak Basori",
                'email' => "basori@fkip.uns.ac.id",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak Ristu saptono",
                'email' => "ristu.uns@gmail.com",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Yuyun estrianto",
                'email' => "yuyun.e@gmail.com",
                'password' => Hash::make("secret")
            ], 
            [
                'name' => "Pak Anif jamaludin",
                'email' => "elhanif@uns.ac.id",
                'password' => Hash::make("secret")
            ],             
            
        ]);
    }

}
