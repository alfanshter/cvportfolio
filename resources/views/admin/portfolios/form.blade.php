@extends('layouts.admin')
@section('title', isset($portfolio->id) ? 'Edit Portfolio' : 'Tambah Portfolio')

@section('admin-content')
<div class="max-w-2xl">
    <form action="{{ isset($portfolio->id) ? route('admin.portfolios.update', $portfolio) : route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($portfolio->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div>
                <label class="form-label">Judul Proyek *</label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Deskripsi Singkat *</label>
                <input type="text" name="short_description" value="{{ old('short_description', $portfolio->short_description) }}" class="form-input" maxlength="300" required>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Kategori *</label>
                    <input type="text" name="category" value="{{ old('category', $portfolio->category) }}" class="form-input" placeholder="Web Application / API / Website" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="completed_at" value="{{ old('completed_at', $portfolio->completed_at?->format('Y-m-d')) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">URL Demo</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $portfolio->demo_url) }}" class="form-input" placeholder="https://...">
                </div>
                <div>
                    <label class="form-label">URL GitHub</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $portfolio->github_url) }}" class="form-input" placeholder="https://github.com/...">
                </div>
                <div>
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}" min="0" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Teknologi (pisahkan koma)</label>
                <input type="text" name="technologies" value="{{ old('technologies', $portfolio->technologies) }}" class="form-input" placeholder="Laravel, Vue.js, MySQL, ...">
            </div>

            <div>
                <label class="form-label">Deskripsi Lengkap (HTML)</label>
                <textarea name="description" rows="8" class="form-input font-mono text-sm resize-none">{{ old('description', $portfolio->description) }}</textarea>
            </div>

            <div>
                <label class="form-label">Thumbnail (max 2MB)</label>
                @if(isset($portfolio->id) && $portfolio->thumbnail)
                <div class="mb-3"><img src="{{ Storage::url($portfolio->thumbnail) }}" class="h-24 rounded-lg object-cover border border-gray-700"></div>
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="form-input text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white file:text-xs cursor-pointer">
            </div>

            <div class="flex flex-wrap gap-6">
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-4 h-4 accent-indigo-500"
                        {{ old('is_featured', $portfolio->is_featured ?? false) ? 'checked' : '' }}>
                    <label for="is_featured" class="text-sm text-gray-300 cursor-pointer">⭐ Featured Project</label>
                </div>
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 accent-indigo-500"
                        {{ old('is_active', $portfolio->is_active ?? true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-300 cursor-pointer">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.portfolios.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
