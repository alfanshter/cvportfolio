@extends('layouts.admin')
@section('title', isset($education->id) ? 'Edit Pendidikan' : 'Tambah Pendidikan')

@section('admin-content')
<div class="max-w-2xl">
    <form action="{{ isset($education->id) ? route('admin.educations.update', $education) : route('admin.educations.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($education->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div>
                <label class="form-label">Nama Institusi *</label>
                <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" class="form-input" required>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Jenjang Pendidikan *</label>
                    <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" class="form-input" placeholder="Sarjana (S1)" required>
                </div>
                <div>
                    <label class="form-label">Jurusan / Bidang Studi *</label>
                    <input type="text" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Tahun Masuk *</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $education->start_date?->format('Y-m-d')) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Tahun Lulus</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $education->end_date?->format('Y-m-d')) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">IPK (opsional)</label>
                    <input type="number" name="gpa" value="{{ old('gpa', $education->gpa) }}" step="0.01" min="0" max="4" class="form-input" placeholder="3.75">
                </div>
                <div>
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $education->sort_order ?? 0) }}" min="0" class="form-input" required>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" name="is_current" id="is_current" value="1" class="w-4 h-4 accent-indigo-500"
                    {{ old('is_current', $education->is_current) ? 'checked' : '' }}>
                <label for="is_current" class="text-sm text-gray-300 cursor-pointer">Masih bersekolah/kuliah di sini</label>
            </div>

            <div>
                <label class="form-label">Deskripsi (opsional)</label>
                <textarea name="description" rows="4" class="form-input resize-none">{{ old('description', $education->description) }}</textarea>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.educations.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
