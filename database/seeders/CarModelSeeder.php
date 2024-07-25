<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    public function run()
    {
        DB::table('car_models')->insert([
            ['name' => 'Model S', 'car_type_id' => 1], // افترض أن 1 هو ID نوع السيارة المناسب
            ['name' => 'Model X', 'car_type_id' => 2],
            // أضف المزيد من موديلات السيارات هنا
        ]);
    }
}
