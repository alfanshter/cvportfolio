@extends('layouts.admin')
@section('title', isset($certificate->id) ? 'Edit Sertifikat' : 'Tambah Sertifikat')

@section('admin-content')
<div class="max-w-xl">
    <form action="{{ isset($certificate->id) ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($certificate->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div>
                <label class="form-label">Nama Sertifikat *</label>
                <input type="text" name="title" value="{{ old('title', $certificate->title) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Penerbit *</label>
                <input type="text" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" class="form-input" placeholder="Google, AWS, Coursera, dll" required>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Tanggal Diterbitkan *</label>
                    <input type="date" name="issued_date" value="{{ old('issued_date', $certificate->issued_date?->format('Y-m-d')) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $certificate->expiry_date?->format('Y-m-d')) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Credential ID</label>
                    <input type="text" name="credential_id" value="{{ old('credential_id', $certificate->credential_id) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $certificate->sort_order ?? 0) }}" min="0" class="form-input" required>
                </div>
            </div>
            <div>
                <label class="form-label">URL Verifikasi</label>
                <input type="url" name="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}" class="form-input" placeholder="https://...">
            </div>
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 accent-indigo-500"
                    {{ old('is_active', $certificate->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-300 cursor-pointer">Tampilkan di website</label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.certificates.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
