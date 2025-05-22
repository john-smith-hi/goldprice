<?php

namespace App\Http\Controllers\User;

class HomeController
{
    function index() {
        return view('user.home');
    }
}
