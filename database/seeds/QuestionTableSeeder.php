<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("questions")->insert([
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya bantuan kebijakan finansial dari universitas merupakan hal penting untuk mendukung e-learning",
                'question_category_id' => 1
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elarning akan tetap banyak digunakan walaupun tidak ada peraturan/SK dari Universitas yang mewajibkan memakai Elearning",
                'question_category_id' => 1
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elarning akan tetap diakses walaupun tidak ada pegawai khusus yang menerima pertanyaan dan keluhan dari pengguna elearning",
                'question_category_id' => 1
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elearning akan makin sering diakses karena ada seminar mengenai e-learning yang diakan oleh Universitas",
                'question_category_id' => 1
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "E-learning yang dapat diakses melalui berbagai media (laptop dan perangkat mobile seperti smartphone atau table) kapan saja dan dimana saja lebih disukai dan menyenangkan",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "E-learning yang mempunyai tingkat konsistensi yang handal dan jarang mengalami down akan meningkatkan intensitas penggunaan e-learning",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "E-learning yang memiliki banyak fitur dan lebih mudah dimengerti lebih disukai dan akan meningkatkan intensitas pengunaan e-learning",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elearning jarang digunakan karena sulit digunakan",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya akan menggunakan elearning walaupun internet lambat",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Keamanan sistem dan jaringan mempengaruhi intensitas penggunaan e-learning",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "E-learning yang mempunyai respon yang handal dan cepat  akan meningkatkan intensitas penggunaan e-learning",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya akan menggunakan elearning karena websitenya enak dipandang.",
                'question_category_id' => 2
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elearning akan tetap diakses walaupun kualitas video dan gambar yang ada tidak bagus",
                'question_category_id' => 3
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya tidak mengakses elearning karena materi yang ada dielarning sama persis dengan materi yang disampaikan di kelas",
                'question_category_id' => 3
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya menggunakan elearning karena saya bisa memilih kapan dan materi apapun yang ada dalam elearing",
                'question_category_id' => 3
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya tidak menggunakan elearning karena jarang memakai komputer/laptop",
                'question_category_id' => 4
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya menggunakan elearning karena saya sering menggunakan internet",
                'question_category_id' => 4
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Kesan dari para peserta didik terhadap adanya  Elearning penting untuk masukan terhadap elearning",
                'question_category_id' => 4
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya tidak menggunakan elaerning karena tidak ada diskusi atau tanya jawab antara pelajar dengan pelajar lain atau pelajar dengan pengajar",
                'question_category_id' => 4
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya menggunakan elearning karena pengajar cukup memperlakukan saya dengan baik ketika mengunakn elearning",
                'question_category_id' => 5
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya menggunakan elearning karena bosan menghadiri pelajaran di kelas",
                'question_category_id' => 5
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Elearning akan tetap digunakan walaupun pengajar tidak memberikan respon yang cepat kepada pertanyaan pelajar maupun saat diskusi",
                'question_category_id' => 5
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya tidak menggunakan elearning karena pengajar tidak menyuruh saya menggunakannya",
                'question_category_id' => 5
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Saya akan menggunakan elearning karena banyak materi yang diupload oleh pengajar saya disana",
                'question_category_id' => 5
            ],
        ]);
    }

}
