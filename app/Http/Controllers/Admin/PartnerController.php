<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::ordered()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $partner = new Partner();
        $partner->name = $validated['name'];
        $partner->url = $validated['url'] ?? null;
        $partner->sort_order = $validated['sort_order'] ?? 0;
        $partner->is_active = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $partner->logo_path = $path;
        }

        $partner->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner başarıyla eklendi.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $partner->name = $validated['name'];
        $partner->url = $validated['url'] ?? null;
        $partner->sort_order = $validated['sort_order'] ?? 0;
        $partner->is_active = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $path = $request->file('logo')->store('partners', 'public');
            $partner->logo_path = $path;
        }

        $partner->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner başarıyla güncellendi.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }
        
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner başarıyla silindi.');
    }
}
