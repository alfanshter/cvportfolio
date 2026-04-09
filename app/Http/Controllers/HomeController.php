<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $profile      = Profile::first();
        $skills       = Skill::active()->get()->groupBy('category');
        $educations   = Education::orderBy('sort_order')->get();
        $portfolios   = Portfolio::active()->get();
        $certificates = Certificate::active()->get();

        return view('home', compact(
            'profile', 'skills', 'educations',
            'portfolios', 'certificates'
        ));
    }
}
