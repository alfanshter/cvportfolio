<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:60',
            'category'   => 'required|string|max:60',
            'level'      => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'required|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        Skill::create($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill ditambahkan!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:60',
            'category'   => 'required|string|max:60',
            'level'      => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'required|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $skill->update($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill dihapus!');
    }
}
