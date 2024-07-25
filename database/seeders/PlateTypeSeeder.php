<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlateTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('plate_types')->insert([
            ['name' => 'Private'],
            ['name' => 'Commercial'],
            // أضف المزيد من أنواع اللوحات هنا
        ]);
    }
}
