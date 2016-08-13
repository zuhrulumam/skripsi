<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
            [
                'category_slug' => uniqid(),
                'category_name' => 'Institutional Involvement',
            ],
            [
                'category_slug' => uniqid(),
                'category_name' => 'Technology',
            ],
            [
                'category_slug' => uniqid(),
                'category_name' => 'Design and Content Quality',
            ],
            [
                'category_slug' => uniqid(),
                'category_name' => 'Student',
            ],
            [
                'category_slug' => uniqid(),
                'category_name' => 'Teacher',
            ],
        ]);
    }
}
