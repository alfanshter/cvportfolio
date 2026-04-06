@extends('layouts.app')
@section('title', 'Portfolio')

@section('content')
<section class="py-32 pt-36 relative overflow-hidden min-h-screen">
    <div class="section-blob-right"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 fade-up in-view">
            <div class="section-label">My Work</div>
            <h1 class="section-title">Portfolio</h1>
            <p class="text-gray-500 max-w-xl mx-auto text-sm">A collection of projects I've built — from web applications to backend APIs.</p>
        </div>

        {{-- Filter tabs --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12 fade-up in-view">
            <a href="{{ route('portfolio.index') }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !$category || $category === 'all' ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/20' : 'text-gray-400 hover:text-white border border-gray-700 hover:border-violet-500/40' }}"
               style="{{ !$category || $category === 'all' ? '' : 'background: rgba(255,255,255,0.03)' }}">
                All
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('portfolio.index', ['category' => $cat]) }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ $category === $cat ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/20' : 'text-gray-400 hover:text-white border border-gray-700 hover:border-violet-500/40' }}"
               style="{{ $category === $cat ? '' : 'background: rgba(255,255,255,0.03)' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        {{-- Grid --}}
        @if($portfolios->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 fade-up in-view">
            @foreach($portfolios as $item)
            <div class="portfolio-card group">
                <div class="portfolio-thumb">
                    @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-900/50 via-indigo-900/50 to-slate-900 flex items-center justify-center">
                            <i class="fas fa-code text-5xl text-violet-800/60"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute top-4 left-4">
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-black/60 text-violet-300 backdrop-blur-sm border border-violet-500/30">
                            {{ $item->category }}
                        </span>
                    </div>
                    @if($item->is_featured)
                    <div class="absolute top-4 right-4">
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-500/80 text-white">⭐ Featured</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                        <a href="{{ route('portfolio.show', $item->slug) }}" class="portfolio-action-btn">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($item->demo_url)
                        <a href="{{ $item->demo_url }}" target="_blank" class="portfolio-action-btn">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @endif
                        @if($item->github_url)
                        <a href="{{ $item->github_url }}" target="_blank" class="portfolio-action-btn">
                            <i class="fab fa-github"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-white text-base mb-2 group-hover:text-violet-300 transition-colors leading-snug">
                        <a href="{{ route('portfolio.show', $item->slug) }}">{{ $item->title }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $item->short_description }}</p>

                    @if($item->technologies)
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice($item->technologies_array, 0, 4) as $tech)
                        <span class="tech-tag text-xs">{{ $tech }}</span>
                        @endforeach
                        @if(count($item->technologies_array) > 4)
                        <span class="text-xs text-gray-600 px-2 py-1">+{{ count($item->technologies_array) - 4 }}</span>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-24 fade-up in-view">
            <div class="w-20 h-20 rounded-3xl bg-gray-800/50 border border-gray-700/50 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-folder-open text-3xl text-gray-600"></i>
            </div>
            <p class="text-gray-500 text-base font-medium">No projects in this category yet.</p>
            <a href="{{ route('portfolio.index') }}" class="text-violet-400 hover:text-violet-300 text-sm mt-2 inline-block transition-colors">View all projects →</a>
        </div>
        @endif
    </div>
</section>
@endsection
