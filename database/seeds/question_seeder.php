<?php

use Illuminate\Database\Seeder;

class question_seeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("questions")->insert([
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya kebijakan finansial dari Universias dianggap lebih penting dari pada adanya SK yang mewajibkan untuk memakai e-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 1,
                'second_category_comparation' => 2,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya kebijakan finansial tidak lebih penting dari pada adanya unit khusus untuk menangani E-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 1,
                'second_category_comparation' => 3,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya kebijakan finansial lebih penting dari pada diadakannya seminar mengenai E-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 1,
                'second_category_comparation' => 4,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Adanya SK yang mewajibkan memakai E-learning lebih penting dari pada dibentuk unit khusus yang menangani E-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 2,
                'second_category_comparation' => 3,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "adanya SK yang mewajibkan memakai E-learning tidak lebih penting daripada diadakan seminar mengenai E-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 2,
                'second_category_comparation' => 4,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dibentuknya devisi khusus untuk menangani E-learning tidak lebih penting dari pada mengadakan seminar mengenai e-learning",
                'question_category_id' => 1,
                'first_category_comparation' => 3,
                'second_category_comparation' => 4,
            ],
            // teknologi
             [
                'question_slug' => uniqid(),
                'question_text' => "membuat sistem E-learning yang dapat diakses dari manapun dan kapanpun lebih penting daripada membuat sistem yang handal dan tidak pernah down",
                'question_category_id' => 2,
                'first_category_comparation' => 5,
                'second_category_comparation' => 6,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Membuat sistem E-learning yang dapat diakses dari manapun dan kapanpun tidak lebih penting dari pada mebuat E-learning yang mempunyai banyak fitur dan mudah digunakan",
                'question_category_id' => 2,
                'first_category_comparation' => 5,
                'second_category_comparation' => 7,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Membuat sistem E-learning yang dapat diakses dari manapun dan kapanpun tidak lebih penting daripada harus mendesain E-learning sedemikian hingga enak dilihat",
                'question_category_id' => 2,
                'first_category_comparation' => 5,
                'second_category_comparation' => 8,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Membuat E-learning yang handal dan tidak pernah down lebih penting daripada menambahkan fitur yang banyak pada E-learning",
                'question_category_id' => 2,
                'first_category_comparation' => 6,
                'second_category_comparation' => 7,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Membuat E-learning yang handal dan tidak pernah down lebih penting daripada harus mendesain E-learning sehingga enak dipandang",
                'question_category_id' => 2,
                'first_category_comparation' => 6,
                'second_category_comparation' => 8,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Menambahkan fitur yang mudah digunakan lebih penting daripada Mendesain E-learning dengan desain yang menarik ",
                'question_category_id' => 2,
                'first_category_comparation' => 7,
                'second_category_comparation' => 8,
            ],
            // desain dan kursus
             [
                'question_slug' => uniqid(),
                'question_text' => "Materi dengan Kualitas gambar dan video yang baik lebih penting daripada materi yang relevan dengan yang diajarkan dikelas",
                'question_category_id' => 3,
                'first_category_comparation' => 9,
                'second_category_comparation' => 10,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Materi dengan kualitas gambar dan video yang baik tidak lebih penting daripada materi yang lengkap",
                'question_category_id' => 3,
                'first_category_comparation' => 9,
                'second_category_comparation' => 11,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Materi dengan kualitas gambar dan video yang baik tidak lebih penting daripada fleksibilitas dalam mengambil materi (bisa mengambil materi diluar jurusan)",
                'question_category_id' => 3,
                'first_category_comparation' => 9,
                'second_category_comparation' => 12,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Materi yang relevan dengan yang diajarkan dikelas lebih penting daripada menyediakan materi yang lengkap",
                'question_category_id' => 3,
                'first_category_comparation' => 10,
                'second_category_comparation' => 11,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Materi yang relevan dengan yang diajarkan dikelas lebih penting daripada menyediakan fleksibilitas dalam mengambil materi yang ada diluar jurusan",
                'question_category_id' => 3,
                'first_category_comparation' => 10,
                'second_category_comparation' => 12,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Menyediakan materi yang lengkap tidak lebih penting daripada menyediakan fleksiibilitas dalam mengambil materi diluar jurusan",
                'question_category_id' => 3,
                'first_category_comparation' => 11,
                'second_category_comparation' => 12,
            ],
            // pelajar
             [
                'question_slug' => uniqid(),
                'question_text' => "Keahlian dan wawasan dalam menggunakan komputer merupakan faktor yang lebih mendorong mahasiswa untuk menggunakan E-learning daripada keahlian dan wawasan dalam menggunakan internet",
                'question_category_id' => 4,
                'first_category_comparation' => 13,
                'second_category_comparation' => 14,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dalam mengembangkan E-learning Keahlian dan wawasan dalam menggunakan komputer harus lebih diperhatikan daripada kesan yang diberikan mahasiswa terhadap E-learning",
                'question_category_id' => 4,
                'first_category_comparation' => 13,
                'second_category_comparation' => 15,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "keahlian dan wawasan dalam menggunakan komputer merupakan faktor yang lebih mendorong mahasiswa untuk menggunakan E-learning daripada adanya diskusi yang diadakan pada E-learning",
                'question_category_id' => 4,
                'first_category_comparation' => 13,
                'second_category_comparation' => 16,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dalam mengembangkan E-learning Keahlian dan wawasan mahasiswa dalam menggunakan internet harus lebih diperhatikan daripada kesan yang diberikan mahasiswa terhadap E-learning",
                'question_category_id' => 4,
                'first_category_comparation' => 14,
                'second_category_comparation' => 15,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Keahlian dan wawasan mahasiswa dalam menggunakan internet merupakan faktor yang lebih mendorong mahasiswa untuk menggunakan E-learning daripada adanya diskusi yang diadakan pada E-learning",
                'question_category_id' => 4,
                'first_category_comparation' => 14,
                'second_category_comparation' => 16,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Dalam menggembangkan E-learning kesan yang diberikan mahasiswa terhadap E-learning tidak harus lebih diperhatikan daripada forum diskusi yang diadakan oleh mahasiswa",
                'question_category_id' => 4,
                'first_category_comparation' => 15,
                'second_category_comparation' => 16,
            ],
            // pengajar
             [
                'question_slug' => uniqid(),
                'question_text' => "Sikap dosen terhadap mahasiswa harus lebih diperhatikan daripada respon yang diberikan dosen terhadap pertanyaan mahasiswa dalam E-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 17,
                'second_category_comparation' => 18,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Sikap dosen terhadap mahasiswa harus lebih diperhatikan daripada menyuruh dosen untuk mengajak mahasiswanya untuk membuka e-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 17,
                'second_category_comparation' => 19,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Sikap dosen terhadap mahasiswa harus lebih diperhatikan daripada keaktivan dosen dalam mengupload materinya ke E-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 17,
                'second_category_comparation' => 20,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "memotivasi dosen agar memberikan respon terhadap pertanyaan mahasiswa tidak lebih penting daripada memotivasi dosen untuk mengajak mahasiswanya menggunakan E-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 18,
                'second_category_comparation' => 19,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "memotivasi dosen agar memberikan respon terhadap pertanyaan mahasiswa tidak lebih penting daripada memotivasi dosen agar sering mengupload materinya ke E-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 18,
                'second_category_comparation' => 20,
            ],
            [
                'question_slug' => uniqid(),
                'question_text' => "Memotivasi dosen agar mengajak mahasiswanya menggunakn E-learning lebih penting daripada memotivasi dosen agar rajin mengupload materinya ke E-learning",
                'question_category_id' => 5,
                'first_category_comparation' => 19,
                'second_category_comparation' => 20,
            ],
        ]);
    }

}
