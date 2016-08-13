<?php

use Illuminate\Database\Seeder;

class expertQuestionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("experts_questions")->insert([
            [
                'question_slug' => uniqid(),
                'question_text' => "Kebijakan dari Universitas tentang penggunaan E-learning lebih penting dalam mendorong mahasiswa maupun dosen untuk mengakses E-learning dari pada sistem dan teknologi E-learning yang bagus 
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Kebijakan dari Universitas tentang penggunaan E-learning lebih penting dalam mendorong mahasiswa maupun dosen untuk mengakses E-learning dari pada kualitas materi yang bagus pada E-learning
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dalam mengembangkan E-learning Kebijakan dari Universitas tentang penggunaan E-learning harus lebih diperhatikan  daripada kesan-kesan yang diberikan mahasiswa tehadap E-learning
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Kebijakan dari Universitas tentang penggunaan E-learning lebih penting dalam mendorong mahasiswa  untuk mengakses E-learning daripada motivasi yang dberikan dosen
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Teknologi dan sistem E-learning yang handal lebih penting daripada materi yang bagus",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dalam mengembangkan E-learning perkembangan teknologi dan sistem E-learning terkini harus lebih diperhatikan daripada kesan-kesan yang diberikan mahasiswa maupun dosen terhadap E-learning 
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Teknologi dan sistem E-learning yang handal merupakan faktor pendorong yang lebih diperhatikan oleh mahasiswa daripada motivasi yang diberikan dari dosen dalam hal pengaksesan E-learning
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Perbaikan kualitas materi pada E-learning harus lebih diperhatikan daripada membuat forum diskusi pada E-learning agar mendorong mahasiswa maupun dosen mengakses E-learning
",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Kualitas materi yang ada pada E-learning lebih membuat mahasiswa tertarik membuka E-learning daripada motivasi yang diberikan dosen",
                'question_category_id' => 6
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya diskusi pada E-learning lebih membuat mahasiswa tertarik membuka E-learning daripada motivasi yang diberikan dosen",
                'question_category_id' => 6
            ],
           
        ]);
    }

}
