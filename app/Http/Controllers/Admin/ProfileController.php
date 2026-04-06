<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrNew();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'tagline'      => 'required|string|max:200',
            'email'        => 'required|email|max:100',
            'phone'        => 'nullable|string|max:30',
            'location'     => 'nullable|string|max:100',
            'website'      => 'nullable|url|max:200',
            'github'       => 'nullable|url|max:200',
            'linkedin'     => 'nullable|url|max:200',
            'twitter'      => 'nullable|url|max:200',
            'instagram'    => 'nullable|url|max:200',
            'about'        => 'required|string',
            'open_to_work' => 'boolean',
            'avatar'       => 'nullable|image|max:2048',
            'resume_file'  => 'nullable|mimes:pdf|max:5120',
        ]);

        $profile = Profile::firstOrNew();

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) Storage::disk('public')->delete($profile->avatar);
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('resume_file')) {
            if ($profile->resume_file) Storage::disk('public')->delete($profile->resume_file);
            $validated['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
        }

        $validated['open_to_work'] = $request->boolean('open_to_work');
        $profile->fill($validated)->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
