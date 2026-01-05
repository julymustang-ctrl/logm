<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;

class ProjectController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        $projects = Project::active()
            ->with('service')
            ->latest()
            ->paginate(12);
        
        return view('frontend.projects.index', compact('projects', 'services'));
    }

    public function show(Project $project)
    {
        if (!$project->is_active) {
            abort(404);
        }
        
        $project->load(['service', 'images']);
        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->where('service_id', $project->service_id)
            ->take(3)
            ->get();
        
        return view('frontend.projects.show', compact('project', 'relatedProjects'));
    }
}
