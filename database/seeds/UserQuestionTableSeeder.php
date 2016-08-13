<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserQuestionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();
        for ($i = 1; $i <= 200; $i++) {
            for ($j = 1; $j <= 24; $j++) {
                DB::table("user_questions")->insert([
                    'rel_user_id' => $i,
                    'rel_question_id' => $j,
                    'rel_answer' => $faker->numberBetween(1, 5)
                ]);
            }
        }
    }

}
