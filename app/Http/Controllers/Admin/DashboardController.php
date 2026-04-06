<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'skills'       => Skill::count(),
            'experiences'  => Experience::count(),
            'educations'   => Education::count(),
            'portfolios'   => Portfolio::count(),
            'certificates' => Certificate::count(),
            'messages'     => Contact::count(),
            'unread'       => Contact::where('is_read', false)->count(),
        ];
        $profile         = Profile::first();
        $recentMessages  = Contact::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'profile', 'recentMessages'));
    }
}
