<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'سيارات صغيرة',
                'image' => 'path/to/small_cars_image.jpg',
            ],
            [
                'name' => 'سيارات متوسطة',
                'image' => 'path/to/medium_cars_image.jpg',
            ],
            [
                'name' => 'سيارات عائلية',
                'image' => 'path/to/family_cars_image.jpg',
            ],
            [
                'name' => 'سيارات فارهة',
                'image' => 'path/to/luxury_cars_image.jpg',
            ],
        ]);
    }
}
