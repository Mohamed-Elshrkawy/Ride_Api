<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CarColorSeeder extends Seeder
{
    public function run()
    {
        DB::table('car_colors')->insert([
            ['color' => 'Red'],
            ['color' => 'Blue'],
            // أضف المزيد من الألوان هنا
        ]);
    }
}
