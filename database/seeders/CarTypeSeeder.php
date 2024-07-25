<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('car_types')->insert([
            ['name' => 'Sedan'],
            ['name' => 'SUV'],
            // أضف المزيد من أنواع السيارات هنا
        ]);
    }
}
