@extends('layouts.admin')
@section('title', 'Keahlian')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $skills->count() }} skill terdaftar</p>
    <a href="{{ route('admin.skills.create') }}" class="btn-primary text-sm py-2 px-4">
        <i class="fas fa-plus"></i> Tambah Skill
    </a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-left">
                <th class="px-6 py-4 text-gray-400 font-medium">Skill</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Kategori</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Level</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Urutan</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Status</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($skills as $skill)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2 font-medium text-white">
                        @if($skill->icon)<i class="{{ $skill->icon }} text-indigo-400 text-base"></i>@endif
                        {{ $skill->name }}
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-400">{{ $skill->category }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-1.5 bg-gray-800 rounded-full w-24">
                            <div class="h-1.5 rounded-full bg-indigo-500" style="width:{{ $skill->level }}%"></div>
                        </div>
                        <span class="text-indigo-400 font-semibold text-xs">{{ $skill->level }}%</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-400">{{ $skill->sort_order }}</td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2 py-1 rounded-full {{ $skill->is_active ? 'bg-emerald-500/10 text-emerald-400' : 'bg-gray-800 text-gray-500' }}">
                        {{ $skill->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="p-2 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Yakin hapus skill ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-gray-600">Belum ada skill.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
