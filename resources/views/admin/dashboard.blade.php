@extends('layouts.admin')
@section('title', 'Dashboard')

@section('admin-content')
{{-- Stats Grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
    $statCards = [
        ['icon' => 'fa-tools',          'color' => 'indigo',  'label' => 'Skills',      'value' => $stats['skills']],
        ['icon' => 'fa-briefcase',       'color' => 'violet',  'label' => 'Pengalaman',   'value' => $stats['experiences']],
        ['icon' => 'fa-graduation-cap',  'color' => 'blue',    'label' => 'Pendidikan',   'value' => $stats['educations']],
        ['icon' => 'fa-folder-open',     'color' => 'cyan',    'label' => 'Portfolio',    'value' => $stats['portfolios']],
        ['icon' => 'fa-certificate',     'color' => 'amber',   'label' => 'Sertifikat',   'value' => $stats['certificates']],
        ['icon' => 'fa-envelope',        'color' => 'emerald', 'label' => 'Total Pesan',  'value' => $stats['messages']],
        ['icon' => 'fa-envelope-open',   'color' => 'red',     'label' => 'Belum Dibaca', 'value' => $stats['unread']],
        ['icon' => 'fa-eye',             'color' => 'pink',    'label' => 'Status',       'value' => $profile?->open_to_work ? 'Active' : 'Off'],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-gray-500 text-sm font-medium">{{ $card['label'] }}</span>
            <div class="w-8 h-8 rounded-lg bg-{{ $card['color'] }}-500/10 flex items-center justify-center">
                <i class="fas {{ $card['icon'] }} text-{{ $card['color'] }}-400 text-sm"></i>
            </div>
        </div>
        <div class="text-2xl font-black text-white">{{ $card['value'] }}</div>
    </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Quick actions --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <h2 class="font-bold text-white mb-4">Aksi Cepat</h2>
        <div class="space-y-2">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors text-gray-400 hover:text-white text-sm">
                <i class="fas fa-user-edit text-indigo-400 w-4"></i> Edit Profil
            </a>
            <a href="{{ route('admin.portfolios.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors text-gray-400 hover:text-white text-sm">
                <i class="fas fa-plus text-indigo-400 w-4"></i> Tambah Portfolio
            </a>
            <a href="{{ route('admin.skills.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors text-gray-400 hover:text-white text-sm">
                <i class="fas fa-plus text-indigo-400 w-4"></i> Tambah Skill
            </a>
            <a href="{{ route('admin.experiences.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors text-gray-400 hover:text-white text-sm">
                <i class="fas fa-plus text-indigo-400 w-4"></i> Tambah Pengalaman
            </a>
            <a href="{{ route('admin.certificates.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors text-gray-400 hover:text-white text-sm">
                <i class="fas fa-plus text-indigo-400 w-4"></i> Tambah Sertifikat
            </a>
        </div>
    </div>

    {{-- Recent messages --}}
    <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-white">Pesan Terbaru</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Lihat semua</a>
        </div>

        @if($recentMessages->count())
        <div class="space-y-3">
            @foreach($recentMessages as $msg)
            <a href="{{ route('admin.contacts.show', $msg) }}" class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-800 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-indigo-600/20 flex items-center justify-center text-indigo-400 font-bold text-xs shrink-0">
                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-white {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</span>
                        <span class="text-xs text-gray-600">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-gray-500 truncate">{{ $msg->subject }}</p>
                </div>
                @if(!$msg->is_read)
                <div class="w-2 h-2 rounded-full bg-indigo-500 shrink-0 mt-1"></div>
                @endif
            </a>
            @endforeach
        </div>
        @else
        <p class="text-gray-600 text-sm text-center py-8">Belum ada pesan masuk.</p>
        @endif
    </div>
</div>
@endsection
