<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/UserDashboard/Home');
    }

    public function profileInfo()
    {
        return Inertia::render('Public/UserDashboard/ProfileInfo', [
            'user' => Auth::guard('web')->user(),
        ]);
    }
}
