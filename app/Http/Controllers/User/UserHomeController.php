<?php

namespace App\Http\Controllers\User;

use App\Models\AccessLog;

class UserHomeController
{
    function index() {
        AccessLog::saveRequest();
        return view('user.home');
    }
}
