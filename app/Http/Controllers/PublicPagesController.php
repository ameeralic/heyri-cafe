<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    public function homePage()
    {
        return Inertia::render('Public/Home');
    }

    public function orderNowPage()
    {
        return Inertia::render('Public/OrderNow');
    }

    public function contactPage()
    {
        return Inertia::render('Public/Contact');
    }
}
