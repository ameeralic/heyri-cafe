<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function home()
    {
        return Inertia::render('AdminDashboard/Home');

    }

    public function profileInfo()
    {
        return Inertia::render('AdminDashboard/ProfileInfo', [
            'user' => Auth::guard('web')->user(),
        ]);

    }
}
