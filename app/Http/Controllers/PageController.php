<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class PageController extends Controller
{
    public function home()
    {
        $featured = Activity::where('activity_date', '>=', now()->toDateString())
                            ->orderBy('activity_date')
                            ->take(6)
                            ->get();

        return view('home', compact('featured'));
    }

    public function contact()
    {
        return view('contact');
    }
}