@extends('layouts.admin')
@section('title', isset($skill->id) ? 'Edit Skill' : 'Tambah Skill')

@section('admin-content')
<div class="max-w-xl">
    <form action="{{ isset($skill->id) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($skill->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div>
                <label class="form-label">Nama Skill *</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" class="form-input @error('name') border-red-500 @enderror" required>
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Kategori *</label>
                <input type="text" name="category" value="{{ old('category', $skill->category) }}" class="form-input @error('category') border-red-500 @enderror" placeholder="Frontend / Backend / Tools / dll" required>
                @error('category')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Level (0–100) *</label>
                <input type="number" name="level" value="{{ old('level', $skill->level ?? 80) }}" min="0" max="100" class="form-input" required>
            </div>

            <div>
                <label class="form-label">Icon Class (Font Awesome)</label>
                <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" class="form-input" placeholder="fab fa-laravel">
                <p class="text-gray-600 text-xs mt-1">Contoh: <code>fab fa-laravel</code>, <code>fab fa-php</code>, <code>fas fa-database</code></p>
            </div>

            <div>
                <label class="form-label">Urutan Tampil *</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" min="0" class="form-input" required>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 accent-indigo-500"
                    {{ old('is_active', $skill->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-300 cursor-pointer">Tampilkan di website</label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.skills.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
