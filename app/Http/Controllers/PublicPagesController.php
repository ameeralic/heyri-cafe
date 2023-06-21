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

    public function aboutPage()
    {
        return Inertia::render('Public/About');
    }

    public function contactPage()
    {
        return Inertia::render('Public/Contact');
    }
}
