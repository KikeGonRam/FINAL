<?php

// app/Http/Controllers/UserDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // Esta vista debe existir en resources/views/user/dashboard.blade.php
    }
}