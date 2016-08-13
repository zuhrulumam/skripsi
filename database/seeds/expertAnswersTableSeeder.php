<?php

use Illuminate\Database\Seeder;

class expertAnswersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("expert_answers")->insert([
            [
                'rel_user_id' => 1,
                'rel_question_id' => 1,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 1,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 1,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 1,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 1,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 1,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 1,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 1,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 1,
                'rel_answer' => 4
            ],
            // pertanyaan ke 2
            [
                'rel_user_id' => 1,
                'rel_question_id' => 2,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 2,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 2,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 2,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 2,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 2,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 2,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 2,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 2,
                'rel_answer' => 4
            ],
            // pertanyaan 3
            [
                'rel_user_id' => 1,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 3,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 3,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 3,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 3,
                'rel_answer' => 4
            ],
            //pertanyaan ke 4
            [
                'rel_user_id' => 1,
                'rel_question_id' => 4,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 4,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 4,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 4,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 4,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 4,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 4,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 4,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 4,
                'rel_answer' => 4
            ],
            //pertanyaan 5
            [
                'rel_user_id' => 1,
                'rel_question_id' => 5,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 5,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 5,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 5,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 5,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 5,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 5,
                'rel_answer' => 1
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 5,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 5,
                'rel_answer' => 3
            ],
            //pertanyaan 6
            [
                'rel_user_id' => 1,
                'rel_question_id' => 6,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 6,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 6,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 6,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 6,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 6,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 6,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 6,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 6,
                'rel_answer' => 2
            ],
            //pertanyaan 7
            [
                'rel_user_id' => 1,
                'rel_question_id' => 7,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 7,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 7,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 7,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 7,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 7,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 7,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 7,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 7,
                'rel_answer' => 2
            ],
            //pertanyaan 8
            [
                'rel_user_id' => 1,
                'rel_question_id' => 8,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 8,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 8,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 8,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 8,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 8,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 8,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 8,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 8,
                'rel_answer' => 3
            ],
            //pertanyaan 9
            [
                'rel_user_id' => 1,
                'rel_question_id' => 9,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 9,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 9,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 9,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 9,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 9,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 9,
                'rel_answer' => 5
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 9,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 9,
                'rel_answer' => 2
            ],
            //pertanyaan 10
            [
                'rel_user_id' => 1,
                'rel_question_id' => 10,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 2,
                'rel_question_id' => 10,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 3,
                'rel_question_id' => 10,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 4,
                'rel_question_id' => 10,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 5,
                'rel_question_id' => 10,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 6,
                'rel_question_id' => 10,
                'rel_answer' => 3
            ],
            [
                'rel_user_id' => 7,
                'rel_question_id' => 10,
                'rel_answer' => 4
            ],
            [
                'rel_user_id' => 8,
                'rel_question_id' => 10,
                'rel_answer' => 2
            ],
            [
                'rel_user_id' => 9,
                'rel_question_id' => 10,
                'rel_answer' => 2
            ],
        ]);
    }

}
