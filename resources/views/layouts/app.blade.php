<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $profile->tagline ?? 'Portfolio & CV Professional' }}">

    <title>@yield('title', 'Home') — {{ config('app.name', 'Portfolio') }}</title>

    <!-- Google Fonts: Inter + Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head')
</head>
<body class="font-sans antialiased bg-[#0a0a12] text-gray-100">

    {{-- ═══════════════════ NAVBAR ═══════════════════ --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo / Name -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center font-black text-white text-sm shadow-lg shadow-violet-500/30 group-hover:scale-110 transition-transform">
                        {{ strtoupper(substr($profile->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="font-bold text-white text-sm tracking-wide hidden sm:block">{{ $profile->name ?? 'Portfolio' }}</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="#hero" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#skills" class="nav-link">Skills</a>
                    <a href="#education" class="nav-link">Education</a>
                    <a href="#portfolio" class="nav-link">Portfolio</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>

                <!-- Right side -->
                <div class="flex items-center gap-3">
                    @if($profile?->resume_file)
                    <a href="{{ Storage::url($profile->resume_file) }}" target="_blank"
                       class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-500 hover:to-indigo-500 text-white text-sm font-semibold transition-all shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 hover:-translate-y-0.5">
                        <i class="fas fa-download text-xs"></i> Resume
                    </a>
                    @endif

                    @auth
                    <a href="{{ url('/dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-700 hover:border-gray-500 text-gray-400 hover:text-white text-sm font-medium transition-all">
                        <i class="fas fa-cog text-xs"></i> Admin
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    @endauth

                    <!-- Mobile menu toggle -->
                    <button id="mobile-menu-btn" class="md:hidden w-9 h-9 rounded-lg bg-gray-800/80 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-800/60 bg-[#0e0e1a]/95 backdrop-blur-xl">
            <div class="px-4 py-4 space-y-1">
                <a href="#hero" class="mobile-nav-link">Home</a>
                <a href="#about" class="mobile-nav-link">About</a>
                <a href="#skills" class="mobile-nav-link">Skills</a>
                <a href="#education" class="mobile-nav-link">Education</a>
                <a href="#portfolio" class="mobile-nav-link">Portfolio</a>
                <a href="#contact" class="mobile-nav-link">Contact</a>
                @if($profile?->resume_file)
                <a href="{{ Storage::url($profile->resume_file) }}" target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold mt-2">
                    <i class="fas fa-download text-xs"></i> Download Resume
                </a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    @yield('content')

    {{-- ═══════════════════ FOOTER ═══════════════════ --}}
    <footer class="relative bg-[#07070f] border-t border-gray-800/50 pt-16 pb-8 overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[200px] bg-violet-600/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-10 mb-12">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center font-black text-white shadow-lg shadow-violet-500/30">
                            {{ strtoupper(substr($profile->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="font-bold text-white text-lg">{{ $profile->name ?? 'Portfolio' }}</span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $profile->tagline ?? 'Full Stack Developer' }}</p>
                    <p class="text-gray-600 text-sm mt-2">{{ $profile->location ?? 'Indonesia' }}</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm tracking-wider uppercase">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="#about" class="footer-link">About Me</a>
                        <a href="#skills" class="footer-link">Skills</a>
                        <a href="#education" class="footer-link">Education</a>
                        <a href="#portfolio" class="footer-link">Portfolio</a>
                        <a href="#contact" class="footer-link">Contact</a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm tracking-wider uppercase">Get In Touch</h4>
                    <div class="space-y-3">
                        @if($profile->email)
                        <a href="mailto:{{ $profile->email }}" class="flex items-center gap-2 text-gray-500 hover:text-violet-400 text-sm transition-colors">
                            <i class="fas fa-envelope w-4"></i> {{ $profile->email }}
                        </a>
                        @endif
                        @if($profile->phone)
                        <a href="tel:{{ $profile->phone }}" class="flex items-center gap-2 text-gray-500 hover:text-violet-400 text-sm transition-colors">
                            <i class="fas fa-phone w-4"></i> {{ $profile->phone }}
                        </a>
                        @endif
                    </div>
                    <!-- Social Links -->
                    <div class="flex gap-3 mt-5">
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
            </div>

            <div class="border-t border-gray-800/50 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} <span class="text-gray-400">{{ $profile->name ?? 'Portfolio' }}</span>. Crafted with <span class="text-violet-500">♥</span> using Laravel & Tailwind CSS.
                </p>
                <a href="#hero" class="w-10 h-10 rounded-xl bg-gray-800 hover:bg-violet-600/30 border border-gray-700 hover:border-violet-500/50 flex items-center justify-center text-gray-500 hover:text-violet-400 transition-all group">
                    <i class="fas fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Mobile menu script -->
    <script>
        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn?.addEventListener('click', () => {
            menu?.classList.toggle('hidden');
        });
        // Close on link click
        menu?.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => menu.classList.add('hidden'));
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Skill bars animation
        const observerOptions = { threshold: 0.3 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.skill-bar').forEach(bar => {
                        bar.style.width = bar.dataset.width + '%';
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        document.querySelectorAll('.skills-section').forEach(el => observer.observe(el));

        // Fade-in on scroll
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

        // Active nav link highlight
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.scrollY >= sectionTop) current = section.getAttribute('id');
            });
            navLinks.forEach(link => {
                link.classList.remove('nav-link-active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('nav-link-active');
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
