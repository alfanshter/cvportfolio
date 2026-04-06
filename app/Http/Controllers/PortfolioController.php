<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Profile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $profile   = Profile::first();
        $query     = Portfolio::active();
        $category  = $request->get('category');

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $portfolios  = $query->orderBy('sort_order')->get();
        $categories  = Portfolio::active()->distinct()->pluck('category')->sort()->values();

        return view('portfolio', compact('profile', 'portfolios', 'categories', 'category'));
    }

    public function show(string $slug)
    {
        $profile   = Profile::first();
        $portfolio = Portfolio::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related   = Portfolio::active()
            ->where('id', '!=', $portfolio->id)
            ->where('category', $portfolio->category)
            ->take(3)->get();

        return view('portfolio-detail', compact('profile', 'portfolio', 'related'));
    }
}
