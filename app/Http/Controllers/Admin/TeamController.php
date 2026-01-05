<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $teams = Team::ordered()->paginate(15);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->processTeamPhoto($request->file('photo'));
        }

        Team::create($data);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Ekip üyesi başarıyla eklendi.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($team->photo) {
                $this->imageService->delete($team->photo);
            }
            $data['photo'] = $this->imageService->processTeamPhoto($request->file('photo'));
        }

        $team->update($data);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Ekip üyesi başarıyla güncellendi.');
    }

    public function destroy(Team $team)
    {
        if ($team->photo) {
            $this->imageService->delete($team->photo);
        }
        
        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', 'Ekip üyesi başarıyla silindi.');
    }
}
