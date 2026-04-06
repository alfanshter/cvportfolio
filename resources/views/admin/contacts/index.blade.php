@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('admin-content')
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-left">
                <th class="px-6 py-4 text-gray-400 font-medium">Pengirim</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Subjek</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Waktu</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Status</th>
                <th class="px-6 py-4 text-gray-400 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($contacts as $msg)
            <tr class="hover:bg-gray-800/50 transition-colors {{ !$msg->is_read ? 'bg-indigo-950/20' : '' }}">
                <td class="px-6 py-4">
                    <div class="font-medium text-white {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</div>
                    <div class="text-xs text-gray-500">{{ $msg->email }}</div>
                </td>
                <td class="px-6 py-4 text-gray-400 max-w-xs truncate">{{ $msg->subject }}</td>
                <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</td>
                <td class="px-6 py-4">
                    @if(!$msg->is_read)
                    <span class="inline-flex items-center gap-1 text-xs px-2 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Baru
                    </span>
                    @else
                    <span class="text-xs text-gray-600">Dibaca</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.contacts.show', $msg) }}" class="p-2 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white transition-all">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white transition-all">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-600">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $contacts->links() }}</div>
@endsection
