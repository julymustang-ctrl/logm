<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Service;
use App\Models\Team;
use App\Models\Setting;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('slug', 'hakkimizda')->firstOrFail();
        $services = Service::active()->ordered()->get();
        $teams = Team::active()->ordered()->get();
        
        return view('frontend.about', compact('page', 'services', 'teams'));
    }

    public function contact()
    {
        $settings = Setting::all()->pluck('value', 'key');
        
        return view('frontend.contact', compact('settings'));
    }

    public function show(Page $page)
    {
        if (!$page->is_active) {
            abort(404);
        }
        
        return view('frontend.page', compact('page'));
    }
}
