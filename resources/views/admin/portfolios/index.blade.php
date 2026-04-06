@extends('layouts.admin')
@section('title', 'Portfolio')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $portfolios->count() }} proyek</p>
    <a href="{{ route('admin.portfolios.create') }}" class="btn-primary text-sm py-2 px-4">
        <i class="fas fa-plus"></i> Tambah Portfolio
    </a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-left">
                <th class="px-6 py-4 text-gray-400 font-medium">Proyek</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Kategori</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Featured</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Status</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($portfolios as $item)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-medium text-white">{{ $item->title }}</div>
                    <div class="text-xs text-gray-600 mt-0.5 truncate max-w-xs">{{ $item->short_description }}</div>
                </td>
                <td class="px-6 py-4"><span class="tag">{{ $item->category }}</span></td>
                <td class="px-6 py-4">
                    @if($item->is_featured)
                    <span class="text-amber-400 text-xs">⭐ Ya</span>
                    @else
                    <span class="text-gray-600 text-xs">—</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2 py-1 rounded-full {{ $item->is_active ? 'bg-emerald-500/10 text-emerald-400' : 'bg-gray-800 text-gray-500' }}">
                        {{ $item->is_active ? 'Aktif' : 'Hidden' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('portfolio.show', $item->slug) }}" target="_blank" class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-400 hover:text-white transition-all">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                        <a href="{{ route('admin.portfolios.edit', $item) }}" class="p-2 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus portfolio ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-600">Belum ada portfolio.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
