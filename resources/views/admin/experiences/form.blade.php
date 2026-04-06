@extends('layouts.admin')
@section('title', isset($experience->id) ? 'Edit Proyek' : 'Tambah Proyek')

@section('admin-content')
<div class="max-w-2xl">
    <form action="{{ isset($experience->id) ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($experience->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama Klien / Instansi *</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $experience->client_name) }}" class="form-input" placeholder="Contoh: Dinas Pendidikan Kota X, PT Maju Bersama" required>
                </div>
                <div>
                    <label class="form-label">Peran / Posisi di Proyek *</label>
                    <input type="text" name="position" value="{{ old('position', $experience->position) }}" class="form-input" placeholder="Contoh: Lead Developer, Full Stack Developer" required>
                </div>
                <div>
                    <label class="form-label">Tipe Proyek *</label>
                    <select name="project_type" class="form-input">
                        @foreach(['Freelance', 'Proyek Pemerintah', 'Proyek Swasta', 'Proyek Perusahaan', 'Open Source', 'Personal Project'] as $type)
                        <option value="{{ $type }}" {{ old('project_type', $experience->project_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Lokasi / Mode</label>
                    <input type="text" name="location" value="{{ old('location', $experience->location) }}" class="form-input" placeholder="Kota, Indonesia / Remote / On-site">
                </div>
                <div>
                    <label class="form-label">Tanggal Mulai *</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}" class="form-input">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" name="is_current" id="is_current" value="1" class="w-4 h-4 accent-indigo-500"
                    {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                <label for="is_current" class="text-sm text-gray-300 cursor-pointer">Proyek masih berjalan / ongoing</label>
            </div>

            <div>
                <label class="form-label">Deskripsi Proyek *</label>
                <textarea name="description" rows="6" class="form-input resize-none" placeholder="Tulis detail proyek, fitur yang dikerjakan, dan pencapaian. Satu baris per poin..." required>{{ old('description', $experience->description) }}</textarea>
                <p class="text-gray-600 text-xs mt-1">Pisahkan setiap poin dengan baris baru (Enter).</p>
            </div>

            <div>
                <label class="form-label">Teknologi yang Digunakan</label>
                <input type="text" name="technologies" value="{{ old('technologies', $experience->technologies) }}" class="form-input" placeholder="Laravel, Vue.js, MySQL, dll (pisahkan dengan koma)">
            </div>

            <div>
                <label class="form-label">Urutan Tampil *</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order ?? 0) }}" min="0" class="form-input" required>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.experiences.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
