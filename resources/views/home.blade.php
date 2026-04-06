@extends('layouts.app')
@section('title', 'Home')

@section('content')

{{-- ══════════════════════════════════════════════════════ --}}
{{--                     HERO SECTION                       --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="hero" class="relative min-h-screen flex items-center overflow-hidden pt-20">

    {{-- Animated background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>
        <div class="hero-blob hero-blob-3"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDQwIEwgNDAgNDAgNDAgMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-60"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">

            {{-- Left: Content --}}
            <div class="flex-1 text-center lg:text-left">

                @if($profile?->open_to_work)
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card border border-emerald-500/30 text-emerald-400 text-sm font-medium mb-8 fade-up">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Available for Work
                </div>
                @else
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card border border-gray-700/50 text-gray-500 text-sm font-medium mb-8 fade-up">
                    <span class="w-2 h-2 rounded-full bg-gray-600"></span>
                    Currently Unavailable
                </div>
                @endif

                <div class="fade-up">
                    <p class="text-gray-400 text-lg font-medium mb-2 tracking-wide">Hello, I'm</p>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-[1.05] mb-4">
                        {{ $profile->name ?? 'Your Name' }}
                    </h1>
                    <div class="flex items-center gap-3 justify-center lg:justify-start mb-6">
                        <div class="h-0.5 w-8 bg-gradient-to-r from-violet-500 to-transparent"></div>
                        <h2 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-violet-400 via-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                            {{ $profile->tagline ?? 'Full Stack Developer' }}
                        </h2>
                        <div class="h-0.5 w-8 bg-gradient-to-l from-cyan-500 to-transparent"></div>
                    </div>
                    <p class="text-gray-400 leading-relaxed text-base max-w-lg mx-auto lg:mx-0 mb-10">
                        {{ Str::limit($profile->about ?? 'Passionate developer crafting elegant digital solutions.', 180) }}
                    </p>
                </div>

                {{-- Stats row --}}
                <div class="flex gap-8 justify-center lg:justify-start mb-10 fade-up">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-black text-white">{{ $experiences->count() }}</div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider mt-0.5">Proyek</div>
                    </div>
                    <div class="w-px bg-gradient-to-b from-transparent via-gray-700 to-transparent"></div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-black text-white">{{ $portfolios->count() }}</div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider mt-0.5">Projects</div>
                    </div>
                    <div class="w-px bg-gradient-to-b from-transparent via-gray-700 to-transparent"></div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-black text-white">{{ $certificates->count() }}</div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider mt-0.5">Certificates</div>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 justify-center lg:justify-start fade-up">
                    <a href="#contact" class="btn-primary group">
                        <i class="fas fa-paper-plane group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        Hire Me
                    </a>
                    <a href="#portfolio" class="btn-ghost group">
                        <i class="fas fa-eye"></i>
                        View Portfolio
                    </a>
                    @if($profile?->resume_file)
                    <a href="{{ Storage::url($profile->resume_file) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl border border-gray-700 hover:border-gray-500 text-gray-400 hover:text-white font-semibold text-sm transition-all hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf text-red-400"></i> Download CV
                    </a>
                    @endif
                </div>

                {{-- Social row --}}
                <div class="flex gap-3 mt-8 justify-center lg:justify-start fade-up">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="social-icon-hero" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="social-icon-hero" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if($profile->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" class="social-icon-hero" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if($profile->instagram)
                    <a href="{{ $profile->instagram }}" target="_blank" class="social-icon-hero" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($profile->email)
                    <a href="mailto:{{ $profile->email }}" class="social-icon-hero" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Right: Avatar Card --}}
            <div class="flex-shrink-0 fade-up">
                <div class="relative">
                    <div class="absolute -inset-4 rounded-3xl bg-gradient-to-br from-violet-600/20 via-indigo-600/10 to-cyan-600/20 blur-2xl"></div>
                    <div class="relative w-72 h-72 sm:w-80 sm:h-80 lg:w-96 lg:h-96 rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                        @if($profile?->avatar)
                            <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-violet-900/50 via-indigo-900/50 to-slate-900 flex items-center justify-center">
                                <span class="text-9xl font-black bg-gradient-to-br from-violet-400 to-indigo-400 bg-clip-text text-transparent select-none">
                                    {{ strtoupper(substr($profile->name ?? 'A', 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    </div>

                    <div class="absolute -bottom-5 -left-5 glass-card border border-white/10 rounded-2xl px-4 py-3 shadow-xl backdrop-blur-xl">
                        <div class="flex items-center gap-2.5 text-sm font-semibold text-white whitespace-nowrap">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-xs">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            {{ $profile->location ?? 'Indonesia' }}
                        </div>
                    </div>

                    <div class="absolute -top-5 -right-5 glass-card border border-violet-500/30 rounded-2xl px-4 py-3 shadow-xl backdrop-blur-xl">
                        <div class="text-sm font-black text-white">{{ $experiences->count() }}+ Projects</div>
                        <div class="text-xs text-violet-400 mt-0.5">Proyek Selesai</div>
                    </div>

                    <div class="absolute top-6 -left-3 w-3 h-3 rounded-full bg-violet-500 shadow-lg shadow-violet-500/50 animate-pulse"></div>
                    <div class="absolute bottom-16 -right-2 w-2 h-2 rounded-full bg-cyan-400 shadow-lg shadow-cyan-400/50 animate-pulse" style="animation-delay:.5s"></div>
                    <div class="absolute top-1/2 -right-4 w-2.5 h-2.5 rounded-full bg-indigo-400 shadow-lg shadow-indigo-400/50 animate-pulse" style="animation-delay:1s"></div>
                </div>
            </div>

        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600 fade-up">
        <div class="w-px h-12 bg-gradient-to-b from-transparent to-violet-500/50 animate-pulse"></div>
        <span class="text-xs tracking-[0.3em] uppercase">Scroll</span>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--                    ABOUT SECTION                       --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="about" class="py-28 relative overflow-hidden">
    <div class="section-blob-left"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="fade-up">
                <div class="section-label">About Me</div>
                <h2 class="section-title">Who I Am</h2>
                <p class="text-gray-400 leading-relaxed text-base mb-8">{{ $profile->about ?? '' }}</p>

                <div class="space-y-4 mb-8">
                    @if($profile->email)
                    <div class="flex items-center gap-4">
                        <div class="info-icon"><i class="fas fa-envelope text-sm"></i></div>
                        <div>
                            <div class="text-xs text-gray-600 uppercase tracking-wider mb-0.5">Email</div>
                            <a href="mailto:{{ $profile->email }}" class="text-gray-300 hover:text-violet-400 transition-colors font-medium">{{ $profile->email }}</a>
                        </div>
                    </div>
                    @endif
                    @if($profile->phone)
                    <div class="flex items-center gap-4">
                        <div class="info-icon"><i class="fas fa-phone text-sm"></i></div>
                        <div>
                            <div class="text-xs text-gray-600 uppercase tracking-wider mb-0.5">Phone</div>
                            <a href="tel:{{ $profile->phone }}" class="text-gray-300 hover:text-violet-400 transition-colors font-medium">{{ $profile->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($profile->location)
                    <div class="flex items-center gap-4">
                        <div class="info-icon"><i class="fas fa-map-marker-alt text-sm"></i></div>
                        <div>
                            <div class="text-xs text-gray-600 uppercase tracking-wider mb-0.5">Location</div>
                            <span class="text-gray-300 font-medium">{{ $profile->location }}</span>
                        </div>
                    </div>
                    @endif
                    @if($profile->website)
                    <div class="flex items-center gap-4">
                        <div class="info-icon"><i class="fas fa-globe text-sm"></i></div>
                        <div>
                            <div class="text-xs text-gray-600 uppercase tracking-wider mb-0.5">Website</div>
                            <a href="{{ $profile->website }}" target="_blank" class="text-violet-400 hover:text-violet-300 transition-colors font-medium">{{ parse_url($profile->website, PHP_URL_HOST) }}</a>
                        </div>
                    </div>
                    @endif
                </div>

                @if($profile?->resume_file)
                <a href="{{ Storage::url($profile->resume_file) }}" target="_blank" class="btn-primary inline-flex">
                    <i class="fas fa-file-download"></i> Download Resume
                </a>
                @endif
            </div>

            <div class="space-y-5 fade-up">
                <div class="glass-card rounded-3xl p-6 border border-white/5">
                    <h3 class="text-white font-bold mb-5 flex items-center gap-2 text-sm">
                        <i class="fas fa-share-alt text-violet-400"></i> Find Me Online
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        @if($profile->github)
                        <a href="{{ $profile->github }}" target="_blank" class="social-card group">
                            <i class="fab fa-github text-xl text-gray-400 group-hover:text-white transition-colors"></i>
                            <div>
                                <div class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">GitHub</div>
                                <div class="text-xs text-gray-600">Source Code</div>
                            </div>
                        </a>
                        @endif
                        @if($profile->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" class="social-card group">
                            <i class="fab fa-linkedin-in text-xl text-blue-400"></i>
                            <div>
                                <div class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">LinkedIn</div>
                                <div class="text-xs text-gray-600">Professional</div>
                            </div>
                        </a>
                        @endif
                        @if($profile->twitter)
                        <a href="{{ $profile->twitter }}" target="_blank" class="social-card group">
                            <i class="fab fa-twitter text-xl text-sky-400"></i>
                            <div>
                                <div class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">Twitter</div>
                                <div class="text-xs text-gray-600">Updates</div>
                            </div>
                        </a>
                        @endif
                        @if($profile->instagram)
                        <a href="{{ $profile->instagram }}" target="_blank" class="social-card group">
                            <i class="fab fa-instagram text-xl text-pink-400"></i>
                            <div>
                                <div class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">Instagram</div>
                                <div class="text-xs text-gray-600">Daily Life</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>

                <div class="glass-card rounded-3xl p-6 border border-white/5">
                    <h3 class="text-white font-bold mb-5 flex items-center gap-2 text-sm">
                        <i class="fas fa-user-check text-violet-400"></i> Quick Facts
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-800/60">
                            <span class="text-gray-500 text-sm">Language</span>
                            <span class="text-gray-200 font-semibold text-sm">Indonesia, English</span>
                        </div>
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-800/60">
                            <span class="text-gray-500 text-sm">Availability</span>
                            <span class="text-sm font-semibold {{ $profile->open_to_work ? 'text-emerald-400' : 'text-gray-500' }}">
                                @if($profile->open_to_work)
                                <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Open to Work</span>
                                @else
                                Not Available
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-800/60">
                            <span class="text-gray-500 text-sm">Proyek</span>
                            <span class="text-gray-200 font-semibold text-sm">{{ $experiences->count() }} Proyek</span>
                        </div>
                        <div class="flex items-center justify-between py-2.5">
                            <span class="text-gray-500 text-sm">Projects Done</span>
                            <span class="text-violet-400 font-bold text-sm">{{ $portfolios->count() }}+ Projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--                   SKILLS SECTION                       --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="skills" class="py-28 relative overflow-hidden">
    <div class="section-blob-right"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <div class="section-label">My Expertise</div>
            <h2 class="section-title">Skills & Technologies</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-sm">Technologies and tools I use to build impactful digital products.</p>
        </div>

        <div class="skills-section space-y-14 fade-up">
            @foreach($skills as $category => $categorySkills)
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-violet-500/20 to-indigo-500/20 border border-violet-500/30 flex items-center justify-center">
                        <i class="fas fa-layer-group text-violet-400 text-xs"></i>
                    </div>
                    <h3 class="text-white font-bold tracking-wide">{{ $category }}</h3>
                    <div class="flex-1 h-px bg-gradient-to-r from-gray-800 to-transparent"></div>
                    <span class="text-xs text-gray-600 font-medium">{{ count($categorySkills) }} skills</span>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($categorySkills as $skill)
                    <div class="skill-card group">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                @if($skill->icon)
                                <div class="w-9 h-9 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center group-hover:border-violet-500/50 transition-colors">
                                    <i class="{{ $skill->icon }} text-violet-400"></i>
                                </div>
                                @endif
                                <span class="font-semibold text-gray-200 group-hover:text-white transition-colors">{{ $skill->name }}</span>
                            </div>
                            <span class="text-xs font-bold text-violet-400 bg-violet-500/10 px-2.5 py-1 rounded-full">{{ $skill->level }}%</span>
                        </div>
                        <div class="skill-track">
                            <div class="skill-bar" style="width: 0" data-width="{{ $skill->level }}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--                 EXPERIENCE SECTION                     --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="experience" class="py-28 relative overflow-hidden">
    <div class="section-blob-left"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <div class="section-label">Project History</div>
            <h2 class="section-title">Proyek yang Dikerjakan</h2>
        </div>

        <div class="relative fade-up">
            <div class="absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-violet-500 via-indigo-500/50 to-transparent hidden md:block"></div>

            <div class="space-y-6 md:pl-20">
                @foreach($experiences as $exp)
                <div class="relative timeline-card group">
                    <div class="absolute -left-[4.8rem] top-8 hidden md:flex">
                        <div class="w-5 h-5 rounded-full border-2 border-violet-500 bg-[#0a0a12] flex items-center justify-center shadow-lg shadow-violet-500/30">
                            <div class="w-2 h-2 rounded-full bg-violet-500 group-hover:bg-violet-400 transition-colors"></div>
                        </div>
                    </div>

                    <div class="glass-card rounded-3xl p-6 lg:p-8 border border-white/5 group-hover:border-violet-500/20 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-5">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-500/20 to-indigo-500/20 border border-violet-500/30 flex items-center justify-center shrink-0 group-hover:border-violet-500/60 transition-colors">
                                    <i class="fas fa-code text-violet-400 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white leading-tight">{{ $exp->position }}</h3>
                                    <div class="flex flex-wrap items-center gap-2 mt-1.5">
                                        <span class="text-violet-400 font-semibold text-sm">{{ $exp->client_name }}</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-700"></span>
                                        <span class="experience-type-tag">{{ $exp->project_type }}</span>
                                        @if($exp->is_current)
                                        <span class="experience-current-tag">Ongoing</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-left sm:text-right shrink-0">
                                <div class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400 bg-gray-800/80 px-3 py-1.5 rounded-full">
                                    <i class="fas fa-calendar-alt text-violet-500 text-xs"></i>
                                    {{ $exp->start_date->format('M Y') }} — {{ $exp->is_current ? 'Sekarang' : $exp->end_date->format('M Y') }}
                                </div>
                                @if($exp->duration)
                                <div class="text-xs text-violet-400/70 mt-1.5 text-center sm:text-right font-medium">{{ $exp->duration }}</div>
                                @endif
                                @if($exp->location)
                                <div class="text-xs text-gray-600 mt-1 flex items-center gap-1 justify-start sm:justify-end">
                                    <i class="fas fa-map-marker-alt"></i> {{ $exp->location }}
                                </div>
                                @endif
                            </div>
                        </div>

                        @if($exp->description)
                        <div class="space-y-1.5 mb-5">
                            @foreach(explode("\n", $exp->description) as $line)
                                @if(trim($line))
                                <div class="flex gap-3 text-sm text-gray-400">
                                    <i class="fas fa-chevron-right text-violet-500/60 mt-1 text-xs shrink-0"></i>
                                    <span>{{ trim($line) }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        @if($exp->technologies)
                        <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-800/60">
                            @foreach($exp->technologies_array as $tech)
                            <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--                 EDUCATION SECTION                      --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="education" class="py-28 relative overflow-hidden">
    <div class="section-blob-right"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <div class="section-label">Academic Background</div>
            <h2 class="section-title">Education</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-6 fade-up">
            @foreach($educations as $edu)
            <div class="glass-card rounded-3xl p-7 border border-white/5 hover:border-violet-500/20 transition-all duration-300 group">
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-600/20 to-indigo-600/20 border border-violet-500/30 flex items-center justify-center shrink-0 group-hover:from-violet-600/30 transition-all">
                        <i class="fas fa-graduation-cap text-violet-400 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white text-base leading-snug">{{ $edu->institution }}</h3>
                        <div class="text-violet-400 font-semibold text-sm mt-1">
                            {{ $edu->degree }}
                            @if($edu->field_of_study)
                            <span class="text-gray-600 mx-1">·</span>
                            <span class="text-gray-400">{{ $edu->field_of_study }}</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                <i class="fas fa-calendar-alt text-xs"></i>
                                {{ $edu->start_date->format('Y') }} — {{ $edu->is_current ? 'Present' : $edu->end_date?->format('Y') }}
                            </span>
                            @if($edu->gpa)
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                GPA {{ number_format($edu->gpa, 2) }}/4.00
                            </span>
                            @endif
                        </div>
                        @if($edu->description)
                        <p class="text-gray-500 text-sm mt-3 leading-relaxed">{{ $edu->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════ --}}
{{--               PORTFOLIO SECTION                        --}}
{{-- ══════════════════════════════════════════════════════ --}}
@if($featured->count())
<section id="portfolio" class="py-28 relative overflow-hidden">
    <div class="section-blob-left"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-end justify-between mb-16 fade-up">
            <div>
                <div class="section-label">Selected Work</div>
                <h2 class="section-title mb-0">Featured Projects</h2>
            </div>
            <a href="{{ route('portfolio.index') }}" class="btn-ghost mt-4 sm:mt-0 text-sm py-2.5 px-5">
                View All <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 fade-up">
            @foreach($featured as $item)
            <div class="portfolio-card group">
                <div class="portfolio-thumb">
                    @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-900/50 via-indigo-900/50 to-slate-900 flex items-center justify-center">
                            <i class="fas fa-code text-5xl text-violet-800/60"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-90 transition-opacity"></div>
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
                    <h3 class="font-bold text-white text-base mb-2 group-hover:text-violet-300 transition-colors leading-snug">{{ $item->title }}</h3>
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
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════════════════ --}}
{{--               CERTIFICATES SECTION                     --}}
{{-- ══════════════════════════════════════════════════════ --}}
@if($certificates->count())
<section id="certificates" class="py-28 relative overflow-hidden">
    <div class="section-blob-right"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <div class="section-label">Achievements</div>
            <h2 class="section-title">Certificates & Licenses</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 fade-up">
            @foreach($certificates as $cert)
            <div class="cert-card group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center shrink-0 group-hover:bg-amber-500/20 transition-colors">
                        <i class="fas fa-certificate text-amber-400 text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-sm leading-snug line-clamp-2 group-hover:text-amber-300 transition-colors">{{ $cert->title }}</h3>
                        <p class="text-violet-400 text-xs font-semibold mt-1">{{ $cert->issuer }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-gray-800/60">
                    <span class="text-gray-600 text-xs">
                        <i class="fas fa-calendar text-xs mr-1"></i>
                        {{ $cert->issued_date->format('M Y') }}
                    </span>
                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank"
                       class="text-xs text-violet-400 hover:text-violet-300 font-semibold flex items-center gap-1 transition-colors">
                        Verify <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════════════════ --}}
{{--                  CONTACT SECTION                       --}}
{{-- ══════════════════════════════════════════════════════ --}}
<section id="contact" class="py-28 relative overflow-hidden">
    <div class="section-blob-left"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <div class="section-label">Let's Connect</div>
            <h2 class="section-title">Get In Touch</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-sm">Have an exciting project or just want to say hi? My inbox is always open.</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-10 fade-up">
            {{-- Contact Info --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="contact-info-card">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/10 border border-violet-500/30 flex items-center justify-center mb-4">
                        <i class="fas fa-envelope text-violet-400"></i>
                    </div>
                    <div class="text-xs text-gray-600 uppercase tracking-wider mb-1">Email Me</div>
                    <a href="mailto:{{ $profile->email }}" class="text-gray-300 hover:text-violet-400 transition-colors font-semibold text-sm break-all">
                        {{ $profile->email ?? 'your@email.com' }}
                    </a>
                </div>

                @if($profile->phone)
                <div class="contact-info-card">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/10 border border-violet-500/30 flex items-center justify-center mb-4">
                        <i class="fas fa-phone-alt text-violet-400"></i>
                    </div>
                    <div class="text-xs text-gray-600 uppercase tracking-wider mb-1">Call Me</div>
                    <a href="tel:{{ $profile->phone }}" class="text-gray-300 hover:text-violet-400 transition-colors font-semibold text-sm">
                        {{ $profile->phone }}
                    </a>
                </div>
                @endif

                @if($profile->location)
                <div class="contact-info-card">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/10 border border-violet-500/30 flex items-center justify-center mb-4">
                        <i class="fas fa-map-marker-alt text-violet-400"></i>
                    </div>
                    <div class="text-xs text-gray-600 uppercase tracking-wider mb-1">Location</div>
                    <span class="text-gray-300 font-semibold text-sm">{{ $profile->location }}</span>
                </div>
                @endif

                <div class="flex flex-wrap gap-3 pt-2">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($profile->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($profile->instagram)
                    <a href="{{ $profile->instagram }}" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-3">
                @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-medium flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg"></i>{{ session('success') }}
                </div>
                @endif

                <div class="glass-card rounded-3xl p-8 border border-white/5">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-input @error('name') !border-red-500/60 @enderror"
                                       placeholder="John Doe" required>
                                @error('name')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-input @error('email') !border-red-500/60 @enderror"
                                       placeholder="john@example.com" required>
                                @error('email')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   class="form-input @error('subject') !border-red-500/60 @enderror"
                                   placeholder="Freelance / Collaboration / Question" required>
                            @error('subject')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="5"
                                      class="form-input resize-none @error('message') !border-red-500/60 @enderror"
                                      placeholder="Hi! I'd like to discuss...">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center py-4 text-base">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
