@extends('layouts.admin')
@section('title', 'Sertifikat')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $certificates->count() }} sertifikat</p>
    <a href="{{ route('admin.certificates.create') }}" class="btn-primary text-sm py-2 px-4">
        <i class="fas fa-plus"></i> Tambah Sertifikat
    </a>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($certificates as $cert)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <div class="flex items-start justify-between gap-2 mb-3">
            <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center shrink-0">
                <i class="fas fa-certificate text-amber-400 text-sm"></i>
            </div>
            <div class="flex items-center gap-1.5 ml-auto">
                <a href="{{ route('admin.certificates.edit', $cert) }}" class="p-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                    <i class="fas fa-edit text-xs"></i>
                </a>
                <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')">
                    @csrf @method('DELETE')
                    <button class="p-1.5 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
        <h3 class="font-bold text-white text-sm leading-snug mb-1">{{ $cert->title }}</h3>
        <p class="text-indigo-400 text-xs mb-2">{{ $cert->issuer }}</p>
        <p class="text-gray-600 text-xs">{{ $cert->issued_date->format('M Y') }}
            @if($cert->expiry_date) · Exp: {{ $cert->expiry_date->format('M Y') }} @endif
        </p>
        @if(!$cert->is_active)
        <span class="mt-2 inline-block text-xs px-2 py-0.5 rounded-full bg-gray-800 text-gray-500">Hidden</span>
        @endif
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-600">Belum ada sertifikat.</div>
    @endforelse
</div>
@endsection
