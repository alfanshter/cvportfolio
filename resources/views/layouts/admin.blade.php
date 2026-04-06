<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard') | CV Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Sidebar nav link */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #94a3b8;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.18s ease;
            position: relative;
            white-space: nowrap;
        }
        .sidebar-link:hover {
            color: #ffffff;
            background-color: rgba(255,255,255,0.06);
        }
        .sidebar-link.active {
            color: #a5b4fc;
            background-color: rgba(99,102,241,0.15);
            border: 1px solid rgba(99,102,241,0.25);
        }
        .sidebar-link .nav-icon {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            font-size: 0.85rem;
            opacity: 0.85;
        }
        .sidebar-link.active .nav-icon {
            opacity: 1;
            color: #818cf8;
        }

        /* Section label */
        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #475569;
            padding: 0 14px;
            margin-top: 20px;
            margin-bottom: 6px;
        }

        /* Scrollbar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 antialiased">

<div class="flex min-h-screen">

    {{-- ======================== SIDEBAR ======================== --}}
    <aside class="w-64 shrink-0 bg-[#0f172a] border-r border-white/[0.05] fixed inset-y-0 left-0 z-40 flex flex-col shadow-xl">

        {{-- Logo / Brand --}}
        <div class="h-16 flex items-center gap-3 px-5 border-b border-white/[0.05] shrink-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <i class="fas fa-code text-white text-xs"></i>
            </div>
            <div>
                <div class="font-bold text-white text-sm leading-tight">CV Admin</div>
                <div class="text-[10px] text-gray-500 leading-tight">Portfolio Manager</div>
            </div>
        </div>

        {{-- Nav Items --}}
        <nav class="sidebar-nav flex-1 overflow-y-auto px-3 py-4">

            {{-- Main --}}
            <p class="sidebar-section-label">Main</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie nav-icon"></i>
                <span>Dashboard</span>
            </a>

            {{-- Content --}}
            <p class="sidebar-section-label">Konten</p>

            <a href="{{ route('admin.profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fas fa-user-circle nav-icon"></i>
                <span>Profil</span>
            </a>

            <a href="{{ route('admin.skills.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group nav-icon"></i>
                <span>Keahlian</span>
            </a>

            <a href="{{ route('admin.experiences.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase nav-icon"></i>
                <span>Pengalaman</span>
            </a>

            <a href="{{ route('admin.educations.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap nav-icon"></i>
                <span>Pendidikan</span>
            </a>

            <a href="{{ route('admin.portfolios.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <i class="fas fa-folder-open nav-icon"></i>
                <span>Portfolio</span>
            </a>

            <a href="{{ route('admin.certificates.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                <i class="fas fa-certificate nav-icon"></i>
                <span>Sertifikat</span>
            </a>

            {{-- Communication --}}
            <p class="sidebar-section-label">Komunikasi</p>

            <a href="{{ route('admin.contacts.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope nav-icon"></i>
                <span>Pesan Masuk</span>
                @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unread > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 min-w-[18px] text-center leading-none">
                        {{ $unread }}
                    </span>
                @endif
            </a>

            {{-- Other --}}
            <p class="sidebar-section-label">Lainnya</p>

            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link">
                <i class="fas fa-external-link-alt nav-icon"></i>
                <span>Lihat Website</span>
            </a>

        </nav>

        {{-- User Info / Logout --}}
        <div class="shrink-0 border-t border-white/[0.05] p-4">
            <div class="flex items-center gap-3 mb-3 px-1">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-sm font-bold shadow shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-500 hover:text-red-400 hover:bg-red-500/10 text-sm font-medium transition-all duration-150">
                    <i class="fas fa-sign-out-alt text-xs"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    {{-- ======================== END SIDEBAR ======================== --}}

    {{-- Main content --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="h-16 bg-gray-900/70 border-b border-white/[0.05] backdrop-blur-md flex items-center px-8 shrink-0 sticky top-0 z-30">
            <div class="flex-1">
                <h1 class="text-base font-semibold text-white tracking-tight">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-gray-500 leading-none mt-0.5">CV Portfolio Admin Panel</p>
            </div>
            <div class="text-xs text-gray-600">
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-8">
            {{-- Flash messages --}}
            @if(session('success'))
            <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                <i class="fas fa-check-circle text-base shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <i class="fas fa-exclamation-circle text-base shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @yield('admin-content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
