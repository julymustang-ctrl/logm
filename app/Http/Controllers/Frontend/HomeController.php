<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $partners = Partner::active()->ordered()->get();
        $featuredProjects = Project::active()->featured()->latest()->take(3)->get();
        $recentProjects = Project::active()->latest()->take(6)->get();
        
        return view('frontend.home', compact('sliders', 'services', 'partners', 'featuredProjects', 'recentProjects'));
    }
}
