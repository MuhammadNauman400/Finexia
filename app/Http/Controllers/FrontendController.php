<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function OurTeam()
    {
        return view('home.team.team_page');
    }

    public function AboutUs()
    {
        return view('home.about.about_us');
    }

    public function OurService()
    {
        return view('home.service.service');
    }
}
