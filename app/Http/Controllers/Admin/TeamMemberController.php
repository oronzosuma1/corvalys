<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(20);
        return view('admin.team-members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience_summary' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/team'), $filename);
            $validated['photo'] = 'uploads/team/' . $filename;
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Membro del team creato.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience_summary' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($teamMember->photo && file_exists(public_path($teamMember->photo))) {
                unlink(public_path($teamMember->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/team'), $filename);
            $validated['photo'] = 'uploads/team/' . $filename;
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Membro del team aggiornato.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo && file_exists(public_path($teamMember->photo))) {
            unlink(public_path($teamMember->photo));
        }

        $teamMember->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Membro del team eliminato.');
    }
}
