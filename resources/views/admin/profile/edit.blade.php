@extends('layouts.admin')
@section('title', 'Edit Profil')

@section('admin-content')
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-3xl">
    @csrf
    @method('PUT')

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <h2 class="font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-user text-indigo-400"></i> Informasi Dasar
        </h2>
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="form-label">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-input @error('name') border-red-500 @enderror" required>
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Tagline / Jabatan *</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="form-input @error('tagline') border-red-500 @enderror" required>
                @error('tagline')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Email *</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-input">
            </div>
            <div>
                <label class="form-label">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="form-input" placeholder="Kota, Negara">
            </div>
            <div>
                <label class="form-label">Website</label>
                <input type="url" name="website" value="{{ old('website', $profile->website) }}" class="form-input" placeholder="https://">
            </div>
        </div>

        <div class="mt-6">
            <label class="form-label">Tentang Saya *</label>
            <textarea name="about" rows="6" class="form-input resize-none" required>{{ old('about', $profile->about) }}</textarea>
        </div>

        <div class="mt-4 flex items-center gap-3">
            <input type="hidden" name="open_to_work" value="0">
            <input type="checkbox" name="open_to_work" id="open_to_work" value="1" class="w-4 h-4 accent-indigo-500"
                {{ old('open_to_work', $profile->open_to_work) ? 'checked' : '' }}>
            <label for="open_to_work" class="text-sm text-gray-300 cursor-pointer">Open to Work (tampilkan badge di website)</label>
        </div>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <h2 class="font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-share-alt text-indigo-400"></i> Social Media
        </h2>
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="form-label"><i class="fab fa-github text-gray-500 mr-1"></i> GitHub URL</label>
                <input type="url" name="github" value="{{ old('github', $profile->github) }}" class="form-input" placeholder="https://github.com/...">
            </div>
            <div>
                <label class="form-label"><i class="fab fa-linkedin text-blue-500 mr-1"></i> LinkedIn URL</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}" class="form-input" placeholder="https://linkedin.com/in/...">
            </div>
            <div>
                <label class="form-label"><i class="fab fa-twitter text-sky-500 mr-1"></i> Twitter URL</label>
                <input type="url" name="twitter" value="{{ old('twitter', $profile->twitter) }}" class="form-input" placeholder="https://twitter.com/...">
            </div>
            <div>
                <label class="form-label"><i class="fab fa-instagram text-pink-500 mr-1"></i> Instagram URL</label>
                <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram) }}" class="form-input" placeholder="https://instagram.com/...">
            </div>
        </div>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <h2 class="font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-image text-indigo-400"></i> Foto & File
        </h2>
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="form-label">Foto Profil (max 2MB)</label>
                @if($profile->avatar)
                <div class="mb-3">
                    <img src="{{ Storage::url($profile->avatar) }}" class="w-20 h-20 rounded-xl object-cover border border-gray-700">
                </div>
                @endif
                <input type="file" name="avatar" accept="image/*" class="form-input text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white file:text-xs cursor-pointer">
            </div>
            <div>
                <label class="form-label">File Resume/CV (PDF, max 5MB)</label>
                @if($profile->resume_file)
                <div class="mb-3 text-sm text-indigo-400">
                    <i class="fas fa-file-pdf text-red-400"></i> CV sudah diupload
                    <a href="{{ Storage::url($profile->resume_file) }}" target="_blank" class="ml-2 text-xs underline">Preview</a>
                </div>
                @endif
                <input type="file" name="resume_file" accept=".pdf" class="form-input text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white file:text-xs cursor-pointer">
            </div>
        </div>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Simpan Profil
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline">Batal</a>
    </div>
</form>
@endsection
