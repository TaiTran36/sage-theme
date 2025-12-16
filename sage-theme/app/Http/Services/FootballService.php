<?php

namespace App\Http\Services;

use App\Constants;
use App\Models\Matches;

class FootballService
{
    public function getListMatches($type)
    {

        $matchesQuery = Matches::select(['competition_id', 'home_team_id', 'away_team_id', 'home_scores', 'away_scores', 'match_time', 'status_id'])->with([
            'homeTeam:id,name,logo,country_id',
            'homeTeam.country:id,name,logo',
            'awayTeam:id,name,logo,country_id',
            'awayTeam.country:id,name,logo',
            'competition:id,name'
        ]);
        if ($type) {
            switch ($type) {
                case 'schedule':
                    $matchesQuery->whereIn('matches.status_id', [
                        Constants::MATCH_STATUS['NOT_STARTED'],
                        Constants::MATCH_STATUS['DELAY'],
                    ]);
                    break;
                case 'live':
                    $matchesQuery->whereIn('matches.status_id', [
                        Constants::MATCH_STATUS['FIRST_HALF'],
                        Constants::MATCH_STATUS['SECOND_HALF'],
                        Constants::MATCH_STATUS['HALF_TIME'],
                        Constants::MATCH_STATUS['OVERTIME_DEPRECATED'],
                        Constants::MATCH_STATUS['OVERTIME'],
                        Constants::MATCH_STATUS['PENALTY_SHOOT_OUT']
                    ]);
                    break;
                case 'finish':
                    $matchesQuery->where('matches.status_id', Constants::MATCH_STATUS['END']);
                    break;
            }
        }
        $matchesQuery = $matchesQuery->whereIn('matches.status_id', [
            Constants::MATCH_STATUS['FIRST_HALF'],
            Constants::MATCH_STATUS['SECOND_HALF'],
            Constants::MATCH_STATUS['HALF_TIME'],
            Constants::MATCH_STATUS['SECOND_HALF'],
            Constants::MATCH_STATUS['OVERTIME_DEPRECATED'],
            Constants::MATCH_STATUS['OVERTIME'],
            Constants::MATCH_STATUS['PENALTY_SHOOT_OUT']
        ])->get()->map(function($match) {
            $match->country_id = $match->homeTeam->country_id;
            $match->country_name = $match->homeTeam->country->name;
            $match->country_logo = $match->homeTeam->country->logo;
            return $match;
        })->toArray();

        $groupByCountry = array_reduce($matchesQuery, function($country, $match) {
            $country[$match['country_id']][] = $match;
            return $country;
        }, []);
        $groupMatches = [];
        foreach ($groupByCountry as $group) {
            $groupByCompetition = array_reduce($group, function($competition, $match) {
                $competition[$match['competition_id']][] = $match;
                return $competition;
            }, []);
            array_push($groupMatches, ...array_values($groupByCompetition));
        }

        return ['groupMatches' => $groupMatches, 'counter' => sizeof($matchesQuery)];
    }
}
