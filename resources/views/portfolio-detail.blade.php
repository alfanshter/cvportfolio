@extends('layouts.app')
@section('title', $portfolio->title . ' — Portfolio')

@section('content')

{{-- ══════════════════════════════════════════════════════ --}}
{{--                PORTFOLIO DETAIL PAGE                   --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section class="py-24 pt-32 relative overflow-hidden min-h-screen">
    <div class="section-blob-right"></div>
    <div class="section-blob-left" style="top: 40%"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Breadcrumb ── --}}
        <nav class="text-sm text-gray-500 mb-8 flex items-center gap-2 fade-up">
            <a href="{{ route('home') }}" class="hover:text-violet-400 transition-colors flex items-center gap-1.5">
                <i class="fas fa-home text-xs"></i> Home
            </a>
            <i class="fas fa-chevron-right text-xs text-gray-700"></i>
            <a href="{{ route('portfolio.index') }}" class="hover:text-violet-400 transition-colors">Portfolio</a>
            <i class="fas fa-chevron-right text-xs text-gray-700"></i>
            <span class="text-gray-300 truncate max-w-xs">{{ $portfolio->title }}</span>
        </nav>

        {{-- ── Header ── --}}
        <div class="mb-8 fade-up">
            <div class="flex flex-wrap items-center gap-3 mb-5">
                <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-violet-500/15 text-violet-300 border border-violet-500/30">
                    {{ $portfolio->category }}
                </span>
                @if($portfolio->is_featured)
                <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-amber-500/15 text-amber-400 border border-amber-500/30">
                    ⭐ Featured Project
                </span>
                @endif
                @if($portfolio->completed_at)
                <span class="text-xs text-gray-500 flex items-center gap-1.5">
                    <i class="fas fa-calendar-check text-violet-500/70 text-xs"></i>
                    Selesai {{ $portfolio->completed_at->format('M Y') }}
                </span>
                @endif
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-white mb-4 leading-tight">{{ $portfolio->title }}</h1>
            <p class="text-gray-400 text-lg leading-relaxed max-w-3xl">{{ $portfolio->short_description }}</p>
        </div>

        {{-- ── Action Buttons ── --}}
        <div class="flex flex-wrap gap-3 mb-10 fade-up">
            @if($portfolio->demo_url)
            <a href="{{ $portfolio->demo_url }}" target="_blank" class="btn-primary">
                <i class="fas fa-external-link-alt"></i> Live Demo
            </a>
            @endif
            @if($portfolio->github_url)
            <a href="{{ $portfolio->github_url }}" target="_blank"
               class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl border border-gray-700 hover:border-violet-500/50 text-gray-300 hover:text-white font-semibold text-sm transition-all hover:-translate-y-0.5 bg-white/3">
                <i class="fab fa-github"></i> Source Code
            </a>
            @endif
            <a href="{{ route('portfolio.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl border border-gray-800 hover:border-gray-600 text-gray-500 hover:text-gray-300 font-semibold text-sm transition-all">
                <i class="fas fa-arrow-left text-xs"></i> Semua Project
            </a>
        </div>

        {{-- ── Main Thumbnail ── --}}
        @if($portfolio->thumbnail)
        <div class="rounded-3xl overflow-hidden border border-gray-800/80 mb-6 shadow-2xl shadow-violet-500/5 cursor-zoom-in fade-up group"
             onclick="openLightbox('{{ Storage::url($portfolio->thumbnail) }}', -1)">
            <div class="relative">
                <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}"
                     class="w-full max-h-[520px] object-cover group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <div class="w-14 h-14 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center border border-white/20">
                        <i class="fas fa-expand text-white text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="rounded-3xl border border-gray-800 mb-6 h-72 bg-gradient-to-br from-violet-900/30 to-slate-900 flex items-center justify-center fade-up">
            <i class="fas fa-code text-7xl text-violet-800/40"></i>
        </div>
        @endif

        {{-- ── Main Content: Two-column layout ── --}}
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Left: Main content (2/3) --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Gallery Images --}}
                @if(!empty($portfolio->images) && count($portfolio->images) > 0)
                <div class="fade-up">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-images text-violet-400 text-sm"></i>
                        </div>
                        <h2 class="text-white font-bold text-lg">Galeri Proyek</h2>
                        <span class="text-xs text-gray-600 font-medium bg-gray-800/60 px-2.5 py-1 rounded-full">
                            {{ count($portfolio->images) + ($portfolio->thumbnail ? 1 : 0) }} foto
                        </span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($portfolio->images as $i => $img)
                        <div class="rounded-2xl overflow-hidden border border-gray-800/80 aspect-video bg-gray-900 cursor-pointer group relative"
                             onclick="openLightbox('{{ Storage::url($img) }}', {{ $i }})">
                            <img src="{{ Storage::url($img) }}" alt="Gallery {{ $i + 1 }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100 duration-200">
                                    <i class="fas fa-expand text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-black/60 text-gray-300">
                                    {{ $i + 2 }}/{{ count($portfolio->images) + ($portfolio->thumbnail ? 1 : 0) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Description --}}
                @if($portfolio->description)
                <div class="glass-card rounded-3xl p-8 border border-white/5 fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-file-alt text-violet-400 text-sm"></i>
                        </div>
                        <h2 class="text-white font-bold text-lg">Tentang Proyek</h2>
                    </div>
                    <div class="text-gray-400 leading-relaxed prose prose-invert prose-sm max-w-none
                                [&_h2]:text-white [&_h2]:font-bold [&_h2]:text-lg [&_h2]:mt-6 [&_h2]:mb-3
                                [&_h3]:text-gray-200 [&_h3]:font-bold [&_h3]:mt-5 [&_h3]:mb-2
                                [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1.5
                                [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:space-y-1.5
                                [&_li]:text-gray-400
                                [&_p]:mb-4 [&_p]:text-gray-400
                                [&_strong]:text-gray-200
                                [&_a]:text-violet-400 [&_a]:hover:text-violet-300">
                        {!! $portfolio->description !!}
                    </div>
                </div>
                @endif

            </div>

            {{-- Right: Sidebar (1/3) --}}
            <div class="space-y-5">

                {{-- Tech Stack --}}
                @if($portfolio->technologies)
                <div class="glass-card rounded-3xl p-6 border border-white/5 fade-up">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-layer-group text-violet-400 text-sm"></i>
                        </div>
                        <h3 class="text-white font-bold">Tech Stack</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($portfolio->technologies_array as $tech)
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl bg-violet-500/10 text-violet-300 border border-violet-500/20 hover:bg-violet-500/20 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-violet-400 shrink-0"></span>
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Project Info --}}
                <div class="glass-card rounded-3xl p-6 border border-white/5 fade-up">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-info-circle text-violet-400 text-sm"></i>
                        </div>
                        <h3 class="text-white font-bold">Info Proyek</h3>
                    </div>
                    <div class="space-y-3.5">
                        <div class="flex items-start gap-3">
                            <span class="text-gray-600 text-xs uppercase tracking-wider w-20 shrink-0 pt-0.5">Kategori</span>
                            <span class="text-gray-300 text-sm font-semibold">{{ $portfolio->category }}</span>
                        </div>
                        @if($portfolio->completed_at)
                        <div class="flex items-start gap-3">
                            <span class="text-gray-600 text-xs uppercase tracking-wider w-20 shrink-0 pt-0.5">Selesai</span>
                            <span class="text-gray-300 text-sm font-semibold">{{ $portfolio->completed_at->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if(!empty($portfolio->images))
                        <div class="flex items-start gap-3">
                            <span class="text-gray-600 text-xs uppercase tracking-wider w-20 shrink-0 pt-0.5">Galeri</span>
                            <span class="text-gray-300 text-sm font-semibold">{{ count($portfolio->images) + ($portfolio->thumbnail ? 1 : 0) }} foto</span>
                        </div>
                        @endif
                        @if($portfolio->technologies)
                        <div class="flex items-start gap-3">
                            <span class="text-gray-600 text-xs uppercase tracking-wider w-20 shrink-0 pt-0.5">Teknologi</span>
                            <span class="text-gray-300 text-sm font-semibold">{{ count($portfolio->technologies_array) }} tools</span>
                        </div>
                        @endif
                        <div class="flex items-start gap-3">
                            <span class="text-gray-600 text-xs uppercase tracking-wider w-20 shrink-0 pt-0.5">Status</span>
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold {{ $portfolio->is_featured ? 'text-amber-400' : 'text-emerald-400' }}">
                                @if($portfolio->is_featured)
                                    <i class="fas fa-star text-xs"></i> Featured
                                @else
                                    <i class="fas fa-check-circle text-xs"></i> Published
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Links --}}
                @if($portfolio->demo_url || $portfolio->github_url)
                <div class="glass-card rounded-3xl p-6 border border-white/5 fade-up">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-link text-violet-400 text-sm"></i>
                        </div>
                        <h3 class="text-white font-bold">Links</h3>
                    </div>
                    <div class="space-y-3">
                        @if($portfolio->demo_url)
                        <a href="{{ $portfolio->demo_url }}" target="_blank"
                           class="flex items-center gap-3 p-3 rounded-2xl bg-violet-500/5 border border-violet-500/20 hover:bg-violet-500/15 hover:border-violet-500/40 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-violet-500/15 flex items-center justify-center shrink-0 group-hover:bg-violet-500/25 transition-colors">
                                <i class="fas fa-external-link-alt text-violet-400 text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-gray-200 group-hover:text-white transition-colors">Live Demo</div>
                                <div class="text-xs text-gray-600 truncate">{{ parse_url($portfolio->demo_url, PHP_URL_HOST) }}</div>
                            </div>
                            <i class="fas fa-arrow-right text-xs text-gray-600 group-hover:text-violet-400 ml-auto transition-colors shrink-0"></i>
                        </a>
                        @endif
                        @if($portfolio->github_url)
                        <a href="{{ $portfolio->github_url }}" target="_blank"
                           class="flex items-center gap-3 p-3 rounded-2xl bg-gray-800/40 border border-gray-700/50 hover:bg-gray-700/40 hover:border-gray-600/50 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-gray-700/50 flex items-center justify-center shrink-0 group-hover:bg-gray-600/50 transition-colors">
                                <i class="fab fa-github text-gray-300 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-200 group-hover:text-white transition-colors">Source Code</div>
                                <div class="text-xs text-gray-600">GitHub Repository</div>
                            </div>
                            <i class="fas fa-arrow-right text-xs text-gray-600 group-hover:text-gray-300 ml-auto transition-colors shrink-0"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="glass-card rounded-3xl p-6 border border-white/5 fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-share-alt text-violet-400 text-sm"></i>
                        </div>
                        <h3 class="text-white font-bold">Share</h3>
                    </div>
                    <div class="flex gap-2">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($portfolio->title) }}"
                           target="_blank"
                           class="flex-1 flex items-center justify-center gap-1.5 p-2.5 rounded-xl bg-sky-500/10 border border-sky-500/20 hover:bg-sky-500/20 transition-colors text-sky-400 text-xs font-semibold">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                           target="_blank"
                           class="flex-1 flex items-center justify-center gap-1.5 p-2.5 rounded-xl bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500/20 transition-colors text-blue-400 text-xs font-semibold">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                        <button onclick="copyToClipboard()"
                           class="flex-1 flex items-center justify-center gap-1.5 p-2.5 rounded-xl bg-gray-700/40 border border-gray-700/50 hover:bg-gray-600/40 transition-colors text-gray-400 hover:text-gray-200 text-xs font-semibold" id="copy-btn">
                            <i class="fas fa-link"></i> Copy
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── Related Projects ── --}}
        @if($related->count())
        <div class="mt-20 fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                    <i class="fas fa-th-large text-violet-400 text-sm"></i>
                </div>
                <h2 class="text-white font-bold text-xl">Proyek Terkait</h2>
                <div class="flex-1 h-px bg-gradient-to-r from-gray-800 to-transparent"></div>
            </div>
            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($related as $item)
                <a href="{{ route('portfolio.show', $item->slug) }}"
                   class="portfolio-card group block hover:border-violet-500/30 transition-all duration-300">
                    <div class="portfolio-thumb">
                        @if($item->thumbnail)
                            <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-violet-900/50 via-indigo-900/50 to-slate-900 flex items-center justify-center">
                                <i class="fas fa-code text-4xl text-violet-800/60"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute top-3 left-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-black/60 text-violet-300 backdrop-blur-sm border border-violet-500/30">
                                {{ $item->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-white text-sm mb-1.5 group-hover:text-violet-300 transition-colors leading-snug">{{ $item->title }}</h4>
                        <p class="text-gray-600 text-xs leading-relaxed line-clamp-2 mb-3">{{ $item->short_description }}</p>
                        @if($item->technologies)
                        <div class="flex flex-wrap gap-1">
                            @foreach(array_slice($item->technologies_array, 0, 3) as $tech)
                            <span class="tech-tag text-xs">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--                   LIGHTBOX MODAL                       --}}
{{-- ══════════════════════════════════════════════════════ --}}
@if($portfolio->thumbnail || !empty($portfolio->images))
@php
    $allImages = [];
    if ($portfolio->thumbnail) $allImages[] = Storage::url($portfolio->thumbnail);
    if (!empty($portfolio->images)) {
        foreach ($portfolio->images as $img) $allImages[] = Storage::url($img);
    }
@endphp

<div id="lightbox"
     class="fixed inset-0 z-[999] bg-black/95 backdrop-blur-md flex items-center justify-center p-4"
     style="display:none!important"
     onclick="closeLightboxOnBg(event)">

    {{-- Close --}}
    <button onclick="closeLightbox()"
            class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10 border border-white/10">
        <i class="fas fa-times text-lg"></i>
    </button>

    {{-- Counter --}}
    <div id="lb-counter"
         class="absolute top-4 left-1/2 -translate-x-1/2 text-xs text-gray-300 bg-black/60 px-4 py-1.5 rounded-full border border-white/10 backdrop-blur-sm z-10 font-semibold">
    </div>

    {{-- Prev --}}
    <button id="lb-prev" onclick="lightboxNav(-1)"
            class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all z-10 border border-white/10 hover:scale-110">
        <i class="fas fa-chevron-left"></i>
    </button>

    {{-- Image --}}
    <img id="lb-img" src="" alt=""
         class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain select-none transition-opacity duration-200">

    {{-- Next --}}
    <button id="lb-next" onclick="lightboxNav(1)"
            class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all z-10 border border-white/10 hover:scale-110">
        <i class="fas fa-chevron-right"></i>
    </button>

    {{-- Thumbnails strip --}}
    @if(count($allImages) > 1)
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10 max-w-[90vw] overflow-x-auto pb-1 px-2">
        @foreach($allImages as $i => $imgUrl)
        <div onclick="goToLightbox({{ $i }})"
             id="lb-thumb-{{ $i }}"
             class="w-14 h-9 rounded-lg overflow-hidden border-2 cursor-pointer shrink-0 transition-all hover:scale-105 opacity-60 hover:opacity-100"
             style="border-color: {{ $i === 0 ? 'rgb(139 92 246)' : 'transparent' }}; opacity: {{ $i === 0 ? '1' : '0.5' }}">
            <img src="{{ $imgUrl }}" alt="thumb {{ $i + 1 }}" class="w-full h-full object-cover">
        </div>
        @endforeach
    </div>
    @endif
</div>

<script>
    const lbImages = @json($allImages);
    let lbIndex = 0;

    function openLightbox(src) {
        lbIndex = lbImages.indexOf(src);
        if (lbIndex < 0) lbIndex = 0;
        updateLightbox();
        const lb = document.getElementById('lightbox');
        lb.style.removeProperty('display');
        document.body.style.overflow = 'hidden';
    }

    function goToLightbox(i) {
        lbIndex = i;
        updateLightbox();
    }

    function updateLightbox() {
        const img = document.getElementById('lb-img');
        img.style.opacity = '0';
        setTimeout(() => {
            img.src = lbImages[lbIndex];
            img.style.opacity = '1';
        }, 100);
        document.getElementById('lb-counter').textContent = (lbIndex + 1) + ' / ' + lbImages.length;

        // Update thumbnail highlights
        lbImages.forEach((_, i) => {
            const el = document.getElementById('lb-thumb-' + i);
            if (el) {
                el.style.borderColor = i === lbIndex ? 'rgb(139 92 246)' : 'transparent';
                el.style.opacity = i === lbIndex ? '1' : '0.5';
            }
        });

        const showNav = lbImages.length > 1;
        document.getElementById('lb-prev').style.display = showNav ? '' : 'none';
        document.getElementById('lb-next').style.display = showNav ? '' : 'none';
    }

    function lightboxNav(dir) {
        lbIndex = (lbIndex + dir + lbImages.length) % lbImages.length;
        updateLightbox();
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = '';
    }

    function closeLightboxOnBg(e) {
        if (e.target === document.getElementById('lightbox')) closeLightbox();
    }

    document.addEventListener('keydown', (e) => {
        const lb = document.getElementById('lightbox');
        if (lb.style.display === 'none' || lb.style.display === '') return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') lightboxNav(1);
        if (e.key === 'ArrowLeft') lightboxNav(-1);
    });

    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('copy-btn');
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            btn.classList.add('text-emerald-400');
            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove('text-emerald-400');
            }, 2000);
        });
    }
</script>
@endif

@endsection
