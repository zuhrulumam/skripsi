<?php

use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("sub_categories")->insert([
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Kebijakan Finansial',
                'rel_category_id' => 1
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Kebijakan Peraturan (SK)',
                'rel_category_id' => 1
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Technical Support',
                'rel_category_id' => 1
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Seminar dan Training Oleh Universitas',
                'rel_category_id' => 1
            ],
            // technology
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Tingkat portability produk',
                'rel_category_id' => 2
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Tingkat reliability produk',
                'rel_category_id' => 2
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Mudah dimengerti dan Mudah digunakan',
                'rel_category_id' => 2
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Desain dan user interface system',
                'rel_category_id' => 2
            ],
            // Desain kursus
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Course quality',
                'rel_category_id' => 3
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'konten yang relevan',
                'rel_category_id' => 3
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Kelngkapan konten',
                'rel_category_id' => 3
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Fleksibilitas dalam mengambil materi',
                'rel_category_id' => 3
            ],
            // Pelajar
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'keahlian dan wawasan menggunakan komputer',
                'rel_category_id' => 4
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Keahlian dan wawasan menggunakan internet',
                'rel_category_id' => 4
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Sikap terhadap e-learning',
                'rel_category_id' => 4
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Adanya forum / diskusi ',
                'rel_category_id' => 4
            ],
            // Pengajar
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Sikap terhadap siswa',
                'rel_category_id' => 5
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'respon yang cepat',
                'rel_category_id' => 5
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Keaktivan pengajar',
                'rel_category_id' => 5
            ],
            [
                'sub_category_slug' => uniqid(),
                'sub_category_name' => 'Sikap terhadap elearning',
                'rel_category_id' => 5
            ],
        ]);
    }

}
