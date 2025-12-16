<?php

namespace App\Database\Seeders;

use App\Constants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MatchesSeeder extends Seeder
{
    protected $competitions;
    protected $countries;
    protected $teams;

    public function __construct($competitions, $countries, $teams)
    {
        $this->competitions = $competitions;
        $this->countries = $countries;
        $this->teams = $teams;
    }
    public function run(): void
    {
        DB::table('matches')->truncate();
        $listMatchesWithCompetition = [];
        foreach ($this->competitions as $competition) {
            if(!str_contains($competition->name, 'Cup'))  {
                $teamsWithCompetition = array_filter($this->teams, function($team) use ($competition) {
                    return $team->competition_id === $competition->id;
                });
                $listMatchesWithCompetition = array_merge($listMatchesWithCompetition, $this->randomMatchTeams($teamsWithCompetition));
            }
            if(str_contains($competition->name, 'Cup'))  {
                // default: teams of indian
                $countryId = array_reduce($this->countries, function ($start, $item) {
                    return $item->name === 'Indian' ? $item->id : $start;
                }, null);
                if($countryId) {
                    $listTeamsByCountry = array_values(
                        array_filter($this->teams, function ($team) use ($countryId) {
                            return $team->country_id === $countryId;
                        })
                    );
                    if(sizeof($listTeamsByCountry) > 1) {
                        $listMatchesWithCompetition = array_merge($listMatchesWithCompetition, $this->randomMatchTeams($listTeamsByCountry));
                    }
                }
            }
        }
        DB::table('matches')->insert($listMatchesWithCompetition);
    }

    function randomMatchTeams($teams): array
    {
        $listMatches = [];
        shuffle($teams);
        for ($i = 0; $i < count($teams); $i += 2) {
            $status = mt_rand(Constants::MATCH_STATUS['FIRST_HALF'], Constants::MATCH_STATUS['PENALTY_SHOOT_OUT']);
            $homeScores = mt_rand(1,5);
            $awayScores = mt_rand(1,5);
            $listMatches[] = [
                'id'              => (string) Str::uuid(),
                'competition_id'  => $teams[$i]->competition_id,
                'home_team_id'    => $teams[$i]->id,
                'away_team_id'    => $teams[$i + 1]->id,
                'status_id'       => $status,
                'match_time'      => $this->randomMatchTimeWithStatus($status),
                'home_scores'     => json_encode([$homeScores, mt_rand(1, $homeScores), mt_rand(1, 3), mt_rand(1, 4), mt_rand(-1, 6), mt_rand(1, 5), mt_rand(1, 5)]),
                'away_scores'     => json_encode([$awayScores, mt_rand(1, $awayScores), mt_rand(1, 3), mt_rand(1, 4), mt_rand(-1, 6), mt_rand(1, 5), mt_rand(1, 5)]),
            ];
        }

        return $listMatches;
    }

    function randomMatchTimeWithStatus($statusId)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        switch ($statusId) {
            case Constants::MATCH_STATUS['NOT_STARTED']:
                return time() + 2 * 3600;
            case Constants::MATCH_STATUS['FIRST_HALF']:
                return time() - mt_rand(10, 45) * 60;
            case Constants::MATCH_STATUS['HALF_TIME']:
                return time() - mt_rand(46, 59) * 60;
            case Constants::MATCH_STATUS['SECOND_HALF']:
                return time() - mt_rand(46, 90) * 60;
            case Constants::MATCH_STATUS['OVERTIME_DEPRECATED']:
            case Constants::MATCH_STATUS['OVERTIME']:
                return time() - mt_rand(91, 120) * 60;
            case Constants::MATCH_STATUS['DELAY']:
            case Constants::MATCH_STATUS['PENALTY_SHOOT_OUT']:
                return time() - mt_rand(121, 130) * 60;
            case Constants::MATCH_STATUS['END']:
                return time() - 130 * 60;
        }
    }
}
