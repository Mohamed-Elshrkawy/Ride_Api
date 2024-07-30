<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CountriesTableSeeder::class,
            CategorySeeder::class,
            CarTypeSeeder::class,
            CarModelSeeder::class,
            CarColorSeeder::class,

        ]);
    }
}
