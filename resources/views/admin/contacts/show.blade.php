@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('admin-content')
<div class="max-w-2xl">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
        <div class="grid sm:grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-800">
            <div>
                <p class="text-gray-500 text-xs mb-1">Dari</p>
                <p class="font-semibold text-white">{{ $contact->name }}</p>
                <a href="mailto:{{ $contact->email }}" class="text-indigo-400 hover:text-indigo-300 text-sm">{{ $contact->email }}</a>
            </div>
            <div>
                <p class="text-gray-500 text-xs mb-1">Diterima</p>
                <p class="text-white text-sm">{{ $contact->created_at->format('d M Y, H:i') }}</p>
                <p class="text-gray-600 text-xs">{{ $contact->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p class="text-gray-500 text-xs mb-1">Subjek</p>
            <p class="font-bold text-white text-lg">{{ $contact->subject }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs mb-3">Pesan</p>
            <div class="bg-gray-800 rounded-xl p-5 text-gray-300 leading-relaxed whitespace-pre-wrap text-sm">{{ $contact->message }}</div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn-primary">
            <i class="fas fa-reply"></i> Balas Email
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')" class="ml-auto">
            @csrf @method('DELETE')
            <button class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white font-semibold text-sm transition-all">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    </div>
</div>
@endsection
