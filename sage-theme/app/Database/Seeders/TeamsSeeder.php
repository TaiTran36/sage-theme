<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamsSeeder extends Seeder
{
    protected $competitions;
    protected $countries;
    public function __construct($competitions, $countries)
    {
        $this->competitions = $competitions;
        $this->countries = $countries;
    }

    public function run(): void
    {
        DB::table('teams')->truncate();
        $listTeams = [];
        foreach ($this->countries as $country) {
            $competitionByCountry = array_filter($this->competitions, function ($competition) use ($country) {
                return str_contains($competition->name, $country->name);
            });
            foreach ($competitionByCountry as $competition) {
                if($competition->name === 'Algeria Women League') {
                    if(!str_contains($competition->name, 'Cup')) {
                        $teamsData = [
                            ['name' => 'CLB nữ Akbou', 'logo' => 'akbou.png'],
                            ['name' => 'Afak Relizean(w)', 'logo' => 'afak.png'],
                            ['name' => 'CLB nữ Jf Khroub', 'logo' => 'khroub.png'],
                            ['name' => 'ASE Alger Centre(w)', 'logo' => 'alger.png'],
                            ['name' => 'CR Belouizdad(w)', 'logo' => 'belouizdad.png'],
                            ['name' => 'ASE Bejaia(w)', 'logo' => 'bejaia.png'],
                        ];
                        foreach ($teamsData as $team) {
                            $listTeams[] = [
                                'id' => Str::uuid(),
                                'competition_id' => $competition->id,
                                'country_id' => $country->id,
                                'name' => $team['name'],
                                'logo' => $team['logo'],
                            ];
                        }
                    }
                }
                if($competition->name === 'Liga U21 Young Algeria') {
                    if(!str_contains($competition->name, 'Cup')) {
                        $teamsData = [
                            ['name' => 'Saoura U21', 'logo' => 'saoura.png'],
                            ['name' => 'Kabylie U21', 'logo' => 'kabylie.png'],
                        ];
                        foreach ($teamsData as $team) {
                            $listTeams[] = [
                                'id' => Str::uuid(),
                                'competition_id' => $competition->id,
                                'country_id' => $country->id,
                                'name' => $team['name'],
                                'logo' => $team['logo'],
                            ];
                        }
                    }
                }
                if($competition->name === 'Super Cup Indian') {
                    if(str_contains($competition->name, 'Cup')) {
                        $teamsData = [
                            ['name' => 'Hyderabad', 'logo' => 'hyderabad.png'],
                            ['name' => 'Sreenidi Deccan', 'logo' => 'sreenidi.png'],
                        ];
                        foreach ($teamsData as $team) {
                            $listTeams[] = [
                                'id' => Str::uuid(),
                                'competition_id' => Str::uuid(),
                                'country_id' => $country->id,
                                'name' => $team['name'],
                                'logo' => $team['logo'],
                            ];
                        }
                    }
                }
                if($competition->name === 'Bangladesh Premier League') {
                    if(!str_contains($competition->name, 'Cup')) {
                        $teamsData = [
                            ['name' => 'Fortis Limited', 'logo' => 'fortis.png'],
                            ['name' => 'Rahamatgonj MFS', 'logo' => 'rahamatgonj.png'],
                            ['name' => 'Sheikh Jamal', 'logo' => 'sheikh.png'],
                            ['name' => 'Bashundhara Kings', 'logo' => 'bashundhara.png'],
                        ];
                        foreach ($teamsData as $team) {
                            $listTeams[] = [
                                'id' => Str::uuid(),
                                'competition_id' => $competition->id,
                                'country_id' => $country->id,
                                'name' => $team['name'],
                                'logo' => $team['logo'],
                            ];
                        }
                    }
                }
            }
        }
        DB::table('teams')->insert($listTeams);
    }
}
