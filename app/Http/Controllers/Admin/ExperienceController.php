<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.form', ['experience' => new Experience()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateExperience($request);
        $validated['is_current'] = $request->boolean('is_current');
        Experience::create($validated);
        return redirect()->route('admin.experiences.index')->with('success', 'Proyek ditambahkan!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $this->validateExperience($request);
        $validated['is_current'] = $request->boolean('is_current');
        $experience->update($validated);
        return redirect()->route('admin.experiences.index')->with('success', 'Proyek diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Proyek dihapus!');
    }

    private function validateExperience(Request $request): array
    {
        return $request->validate([
            'client_name'  => 'required|string|max:100',
            'position'     => 'required|string|max:100',
            'project_type' => 'required|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_current'   => 'boolean',
            'location'     => 'nullable|string|max:100',
            'description'  => 'required|string',
            'technologies' => 'nullable|string|max:300',
            'sort_order'   => 'required|integer|min:0',
        ]);
    }
}
