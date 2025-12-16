<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CompetitionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('competitions')->truncate();
        DB::table('competitions')->insert([
            [
                'id'   => Str::uuid(),
                'name' => 'Algeria Women League',
                'logo' => 'algeria-women.png',
            ],
            [
                'id'   => Str::uuid(),
                'name' => 'Liga U21 Young Algeria',
                'logo' => 'algeria-young.png',
            ],
            [
                'id'   => Str::uuid(),
                'name' => 'Super Cup Indian',
                'logo' => 'india-cup.png',
            ],
            [
                'id'   => Str::uuid(),
                'name' => 'Bangladesh Premier League',
                'logo' => 'bpl.png',
            ],
        ]);
    }
}
