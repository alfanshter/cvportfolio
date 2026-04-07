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
        <div class="rounded-2xl overflow-hidden border border-gray-800 mb-8 shadow-2xl shadow-indigo-500/5 cursor-zoom-in"
             onclick="openLightbox('{{ Storage::url($portfolio->thumbnail) }}', 0)">
            <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full hover:scale-[1.01] transition-transform duration-300">
        </div>
        @else
        <div class="rounded-2xl border border-gray-800 mb-8 h-64 bg-gray-900 flex items-center justify-center">
            <i class="fas fa-image text-6xl text-gray-700"></i>
        </div>
        @endif

        {{-- Gallery Images --}}
        @if(!empty($portfolio->images) && count($portfolio->images) > 0)
        <div class="mb-10">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">
                <i class="fas fa-images text-indigo-400 mr-2"></i>Galeri Proyek
                <span class="text-gray-600 normal-case font-normal ml-1">({{ count($portfolio->images) }} gambar)</span>
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($portfolio->images as $i => $img)
                <div class="rounded-xl overflow-hidden border border-gray-800 aspect-video bg-gray-900 cursor-pointer group relative"
                     onclick="openLightbox('{{ Storage::url($img) }}', {{ $i }})">
                    <img src="{{ Storage::url($img) }}" alt="Gallery {{ $i + 1 }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                        <i class="fas fa-expand text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg drop-shadow"></i>
                    </div>
                </div>
                @endforeach
            </div>
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

{{-- ── LIGHTBOX MODAL ── --}}
@if($portfolio->thumbnail || !empty($portfolio->images))
<div id="lightbox" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-sm flex items-center justify-center p-4"
     style="display:none!important" onclick="closeLightboxOnBg(event)">

    {{-- Close --}}
    <button onclick="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
        <i class="fas fa-times"></i>
    </button>

    {{-- Prev --}}
    <button id="lb-prev" onclick="lightboxNav(-1)"
        class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
        <i class="fas fa-chevron-left"></i>
    </button>

    {{-- Image --}}
    <img id="lb-img" src="" alt="" class="max-w-full max-h-[85vh] rounded-xl shadow-2xl object-contain select-none">

    {{-- Next --}}
    <button id="lb-next" onclick="lightboxNav(1)"
        class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
        <i class="fas fa-chevron-right"></i>
    </button>

    {{-- Counter --}}
    <div id="lb-counter" class="absolute bottom-4 left-1/2 -translate-x-1/2 text-xs text-gray-400 bg-black/50 px-3 py-1 rounded-full"></div>
</div>

<script>
    // Build image list: thumbnail first, then gallery
    const lbImages = [
        @if($portfolio->thumbnail) '{{ Storage::url($portfolio->thumbnail) }}', @endif
        @if(!empty($portfolio->images))
            @foreach($portfolio->images as $img) '{{ Storage::url($img) }}', @endforeach
        @endif
    ];
    let lbIndex = 0;

    function openLightbox(src, galleryIndex) {
        // galleryIndex: -1 = thumbnail, >=0 = gallery item
        lbIndex = lbImages.indexOf(src);
        if (lbIndex < 0) lbIndex = 0;
        updateLightbox();
        document.getElementById('lightbox').style.removeProperty('display');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        const img = document.getElementById('lb-img');
        img.src = lbImages[lbIndex];
        document.getElementById('lb-counter').textContent = (lbIndex + 1) + ' / ' + lbImages.length;
        document.getElementById('lb-prev').style.display = lbImages.length <= 1 ? 'none' : '';
        document.getElementById('lb-next').style.display = lbImages.length <= 1 ? 'none' : '';
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

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const lb = document.getElementById('lightbox');
        if (lb.style.display === 'none' || lb.style.display === '') return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') lightboxNav(1);
        if (e.key === 'ArrowLeft') lightboxNav(-1);
    });
</script>
@endif

@endsection
