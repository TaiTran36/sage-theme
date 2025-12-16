<?php

namespace App\Console\Commands;

use App\Database\Seeders\CountriesSeeder;
use App\Database\Seeders\CompetitionsSeeder;
use App\Database\Seeders\MatchesSeeder;
use App\Database\Seeders\TeamsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run database seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new CountriesSeeder())->run();
        (new CompetitionsSeeder())->run();
        $competitions = DB::table('competitions')->select(['id', 'name'])->get()->toArray();
        $countries = DB::table('countries')->select(['id', 'name'])->get()->toArray();
        (new TeamsSeeder($competitions, $countries))->run();
        $teams = DB::table('teams')->select(['id', 'competition_id', 'country_id'])->get()->toArray();
        (new MatchesSeeder($competitions, $countries, $teams))->run();
    }
}
