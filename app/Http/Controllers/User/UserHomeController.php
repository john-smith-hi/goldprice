<?php

namespace App\Http\Controllers\User;

use App\Models\AccessLog;
use App\Models\Setting;

class UserHomeController
{
    function index() {
        AccessLog::saveRequest();
        $MAIN_SJC_TYPE_GOLD_VN_ID = Setting::where('name','MAIN_SJC_TYPE_GOLD_VN_ID')->pluck('value')->first();
        $MAIN_9999_TYPE_GOLD_VN_ID = Setting::where('name','MAIN_9999_TYPE_GOLD_VN_ID')->pluck('value')->first();
        $MAIN_TYPE_GOLD_WORLD_ID = Setting::where('name','MAIN_TYPE_GOLD_WORLD_ID')->pluck('value')->first();
        return view('user.home', [
            'MAIN_SJC_TYPE_GOLD_VN_ID' => $MAIN_SJC_TYPE_GOLD_VN_ID,
            'MAIN_9999_TYPE_GOLD_VN_ID' => $MAIN_9999_TYPE_GOLD_VN_ID,
            'MAIN_TYPE_GOLD_WORLD_ID' => $MAIN_TYPE_GOLD_WORLD_ID,
        ]);
    }
}
