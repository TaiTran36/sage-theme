<?php

namespace App\Http\Controllers;

use App\Http\Services\FootballService;
use Illuminate\Http\Request;

class FootballController
{
    protected $footballService;
    public function __construct(FootballService $footballService)
    {
        $this->footballService = $footballService;
    }

    public function index(Request $request)
    {
        $type = $request->query('type');
        if($type !== null && !in_array($type, ['schedule', 'live', 'finish'])) {
            return view('404');
        }
        $result = $this->footballService->getListMatches($type);
        $groupMatches = $result['groupMatches'];
        $counter = $result['counter'];

        return view('index', compact('groupMatches','counter'));
    }
}
