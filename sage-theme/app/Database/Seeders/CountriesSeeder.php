<?php

namespace App\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('countries')->truncate();
        DB::table('countries')->insert([
            [
                'id' => (string) Str::uuid(),
                'name' => 'Algeria',
                'logo' => 'algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Indian',
                'logo' => 'india',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Bangladesh',
                'logo' => 'bangladesh',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
