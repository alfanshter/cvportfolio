<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('sort_order')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.form', ['education' => new Education()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateEducation($request);
        $validated['is_current'] = $request->boolean('is_current');
        Education::create($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Pendidikan ditambahkan!');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.form', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $this->validateEducation($request);
        $validated['is_current'] = $request->boolean('is_current');
        $education->update($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Pendidikan diperbarui!');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return back()->with('success', 'Pendidikan dihapus!');
    }

    private function validateEducation(Request $request): array
    {
        return $request->validate([
            'institution'    => 'required|string|max:150',
            'degree'         => 'required|string|max:100',
            'field_of_study' => 'required|string|max:150',
            'start_date'     => 'required|date',
            'end_date'       => 'nullable|date',
            'is_current'     => 'boolean',
            'gpa'            => 'nullable|numeric|min:0|max:4',
            'description'    => 'nullable|string',
            'sort_order'     => 'required|integer|min:0',
        ]);
    }
}
