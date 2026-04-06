@extends('layouts.admin')
@section('title', 'Proyek yang Dikerjakan')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $experiences->count() }} proyek</p>
    <a href="{{ route('admin.experiences.create') }}" class="btn-primary text-sm py-2 px-4">
        <i class="fas fa-plus"></i> Tambah Proyek
    </a>
</div>

<div class="space-y-4">
    @forelse($experiences as $exp)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
                <h3 class="font-bold text-white">{{ $exp->position }}</h3>
                <span class="tag text-xs">{{ $exp->project_type }}</span>
                @if($exp->is_current)
                <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Ongoing</span>
                @endif
            </div>
            <div class="text-indigo-400 text-sm font-medium">{{ $exp->client_name }}</div>
            <div class="text-gray-500 text-xs mt-1">
                {{ $exp->start_date->format('M Y') }} — {{ $exp->is_current ? 'Sekarang' : $exp->end_date->format('M Y') }}
                · {{ $exp->duration }}
                @if($exp->location) · {{ $exp->location }} @endif
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.experiences.edit', $exp) }}" class="p-2 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                <i class="fas fa-edit text-xs"></i>
            </a>
            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                @csrf @method('DELETE')
                <button class="p-2 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                    <i class="fas fa-trash text-xs"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-16 text-gray-600">Belum ada proyek yang ditambahkan.</div>
    @endforelse
</div>
@endsection
