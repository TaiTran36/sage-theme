<?php

namespace App\Helpers;

use App\Constants;

class Common
{
    public static function convertTimeMatch($time, $status)
    {
        if(in_array($status, [Constants::MATCH_STATUS['FIRST_HALF'], Constants::MATCH_STATUS['SECOND_HALF']])) {
        }
        switch ($status) {
            case Constants::MATCH_STATUS['NOT_STARTED']:
                return 'Chưa bắt đầu';
            case Constants::MATCH_STATUS['SECOND_HALF']:
            case Constants::MATCH_STATUS['FIRST_HALF']:
                $now = time();
                return abs(round(($time - $now) / 60)) . "'";
            case Constants::MATCH_STATUS['HALF_TIME']:
                return 'Nghỉ giữa hiệp';
            case Constants::MATCH_STATUS['OVERTIME_DEPRECATED']:
            case Constants::MATCH_STATUS['OVERTIME']:
                return "Hiệp phụ";
            case Constants::MATCH_STATUS['END']:
                return "Đã kết thúc";
            case Constants::MATCH_STATUS['DELAY']:
                return "Đang dừng trận đâấu";
            case Constants::MATCH_STATUS['PENALTY_SHOOT_OUT']:
                return "Đang đá luân lưu";
        }
    }

    public static function convertTimeStart($time)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        return date('H:i', $time);
    }
}
