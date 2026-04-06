@extends('layouts.admin')
@section('title', 'Pendidikan')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $educations->count() }} riwayat pendidikan</p>
    <a href="{{ route('admin.educations.create') }}" class="btn-primary text-sm py-2 px-4">
        <i class="fas fa-plus"></i> Tambah Pendidikan
    </a>
</div>

<div class="space-y-4">
    @forelse($educations as $edu)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="flex-1">
            <h3 class="font-bold text-white mb-0.5">{{ $edu->institution }}</h3>
            <div class="text-indigo-400 text-sm">{{ $edu->degree }} — {{ $edu->field_of_study }}</div>
            <div class="text-gray-500 text-xs mt-1">
                {{ $edu->start_date->format('Y') }} — {{ $edu->is_current ? 'Sekarang' : $edu->end_date?->format('Y') }}
                @if($edu->gpa) · IPK {{ number_format($edu->gpa, 2) }} @endif
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.educations.edit', $edu) }}" class="p-2 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                <i class="fas fa-edit text-xs"></i>
            </a>
            <form action="{{ route('admin.educations.destroy', $edu) }}" method="POST" onsubmit="return confirm('Hapus data pendidikan ini?')">
                @csrf @method('DELETE')
                <button class="p-2 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                    <i class="fas fa-trash text-xs"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-16 text-gray-600">Belum ada data pendidikan.</div>
    @endforelse
</div>
@endsection
