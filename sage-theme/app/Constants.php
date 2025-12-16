<?php

namespace App;

class Constants
{
    public const  MATCH_STATUS = [
        'NOT_STARTED'  => 1,
        'FIRST_HALF'  => 2,
        'HALF_TIME'  => 3,
        'SECOND_HALF'  => 4,
        'OVERTIME'  => 5,
        'OVERTIME_DEPRECATED'  => 6,
        'PENALTY_SHOOT_OUT'  => 7,
        'END'  => 8,
        'DELAY'  => 9,
    ];
}
