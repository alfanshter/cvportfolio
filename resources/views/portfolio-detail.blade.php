@extends('layouts.app')
@section('title', $portfolio->title)

@section('content')
<section class="py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('portfolio.index') }}" class="hover:text-indigo-400 transition-colors">Portfolio</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-300">{{ $portfolio->title }}</span>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="tag">{{ $portfolio->category }}</span>
                @if($portfolio->is_featured)
                <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30">⭐ Featured</span>
                @endif
                @if($portfolio->completed_at)
                <span class="text-xs text-gray-500">Selesai {{ $portfolio->completed_at->format('M Y') }}</span>
                @endif
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white mb-4">{{ $portfolio->title }}</h1>
            <p class="text-gray-400 text-lg leading-relaxed">{{ $portfolio->short_description }}</p>
        </div>

        {{-- Action buttons --}}
        <div class="flex flex-wrap gap-3 mb-10">
            @if($portfolio->demo_url)
            <a href="{{ $portfolio->demo_url }}" target="_blank" class="btn-primary">
                <i class="fas fa-external-link-alt"></i> Live Demo
            </a>
            @endif
            @if($portfolio->github_url)
            <a href="{{ $portfolio->github_url }}" target="_blank" class="btn-outline">
                <i class="fab fa-github"></i> Source Code
            </a>
            @endif
        </div>

        {{-- Thumbnail --}}
        @if($portfolio->thumbnail)
        <div class="rounded-2xl overflow-hidden border border-gray-800 mb-10 shadow-2xl shadow-indigo-500/5">
            <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full">
        </div>
        @else
        <div class="rounded-2xl border border-gray-800 mb-10 h-64 bg-gray-900 flex items-center justify-center">
            <i class="fas fa-image text-6xl text-gray-700"></i>
        </div>
        @endif

        {{-- Technologies --}}
        @if($portfolio->technologies)
        <div class="card p-5 mb-8">
            <h3 class="font-bold text-white mb-3 text-sm uppercase tracking-wider">Tech Stack</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($portfolio->technologies_array as $tech)
                <span class="tag">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Description --}}
        @if($portfolio->description)
        <div class="card p-8 mb-10 prose prose-invert prose-sm max-w-none">
            <h2 class="text-xl font-bold text-white mb-4">Tentang Proyek</h2>
            <div class="text-gray-400 leading-relaxed [&_h3]:text-white [&_h3]:font-bold [&_h3]:mt-6 [&_h3]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1 [&_li]:text-gray-400 [&_p]:mb-4">
                {!! $portfolio->description !!}
            </div>
        </div>
        @endif

        {{-- Related Projects --}}
        @if($related->count())
        <div class="mt-16">
            <h2 class="text-xl font-bold text-white mb-6">Proyek Terkait</h2>
            <div class="grid sm:grid-cols-3 gap-4">
                @foreach($related as $item)
                <a href="{{ route('portfolio.show', $item->slug) }}" class="card p-4 glow-card transition-all duration-300 hover:border-indigo-500/50 group">
                    <div class="text-xs text-indigo-400 font-medium mb-1">{{ $item->category }}</div>
                    <h4 class="font-bold text-white text-sm group-hover:text-indigo-300 transition-colors">{{ $item->title }}</h4>
                    <p class="text-gray-600 text-xs mt-2 line-clamp-2">{{ $item->short_description }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
