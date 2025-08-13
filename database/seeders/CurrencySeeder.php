<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            ['id' => 1, 'code' => 'USD', 'name' => 'US Dollar'],
            ['id' => 2, 'code' => 'EUR', 'name' => 'Euro'],
            ['id' => 3, 'code' => 'GBP', 'name' => 'British Pound'],
            ['id' => 4, 'code' => 'JPY', 'name' => 'Japanese Yen'],
            ['id' => 5, 'code' => 'AUD', 'name' => 'Australian Dollar'],
        ]);
    }
}
