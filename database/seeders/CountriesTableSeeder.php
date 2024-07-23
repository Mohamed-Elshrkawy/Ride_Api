<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name' => 'Saudi Arabia', 'flag' => '🇸🇦', 'code' =>'+966'],
            ['name' => 'United Arab Emirates', 'flag' => '🇦🇪', 'code' =>'+971'],
            ['name' => 'Egypt', 'flag' => '🇪🇬', 'code' =>  '+20'],
        ];

        DB::table('countries')->insert($countries);
    }
}
