<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/hero/logo_puri.png') }}">
    <title>@yield('title', 'Puri Agung Permai RW12') - Puri Agung Permai RW12</title>
    <meta name="description" content="@yield('meta_description', 'Portal resmi Puri Agung Permai RW12, Kelurahan Gelam Jaya, Kecamatan Pasar Kemis, Kabupaten Tangerang. Informasi berita, pengumuman, kegiatan, dan layanan warga.')">
    <meta name="keywords" content="@yield('meta_keywords', 'RW12, Puri Agung Permai, Pasar Kemis, Tangerang, portal warga, berita lingkungan')">
    <meta property="og:title" content="@yield('og_title', 'Puri Agung Permai RW12')">
    <meta property="og:description" content="@yield('og_description', 'Portal resmi Puri Agung Permai RW12. Informasi berita, pengumuman, kegiatan, dan layanan warga.')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('images/hero/logo_puri.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Puri Agung Permai RW12')">
    <meta name="twitter:description" content="@yield('og_description', 'Portal resmi Puri Agung Permai RW12. Informasi berita, pengumuman, kegiatan, dan layanan warga.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/hero/logo_puri.png'))">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <style>
        :root {
            --clr-primary: #E11D48;
            --clr-primary-dark: #BE123C;
            --clr-secondary: #00B38C;
            --clr-surface: #FAFAFA;
            --clr-body: #F5F5F5;
            --clr-title: #0a0a0a;
            --clr-text: #404040;
            --clr-border: rgba(128, 128, 128, 0.25);
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        .c-primary { color: var(--clr-primary); }
        .c-title { color: var(--clr-title); }
        .c-text { color: var(--clr-text); }
        .c-muted { color: rgba(64, 64, 64, 0.7); }
        .c-white { color: #fff; }
        .bg-primary { background-color: var(--clr-primary); }
        .bg-primary-dark { background-color: var(--clr-primary-dark); }
        .bg-surface { background-color: var(--clr-surface); }
        .bg-body { background-color: var(--clr-body); }
        .border-soft { border-color: var(--clr-border); }
        .hover\:c-primary:hover { color: var(--clr-primary); }
        .hover\:bg-primary:hover { background-color: var(--clr-primary); }
        .hover\:bg-primary-dark:hover { background-color: var(--clr-primary-dark); }
        .hover\:bg-body:hover { background-color: var(--clr-body); }

        .header-inner { transition: background-color .2s ease-in-out, box-shadow .2s ease-in-out; }
        .header-inner.scrolled { background-color: var(--clr-surface); box-shadow: 0 0 12px 4px rgba(0, 0, 0, 0.10); }

        .mega-menu { position: relative; }
        .mega-chevron { transition: transform .2s ease; }
        .mega-menu.open .mega-chevron,
        .mega-menu:hover .mega-chevron { transform: rotate(-90deg); }
        .mega-menu-panel {
            position: absolute; top: calc(100% + 10px); left: 50%;
            transform: translate(-50%, -4px);
            width: 340px;
            background: var(--clr-surface);
            border: 1px solid var(--clr-border);
            border-radius: 6px;
            box-shadow: 0 4px 12px 4px rgba(0, 0, 0, 0.05);
            opacity: 0; visibility: hidden;
            transition: all .2s ease;
            padding: 8px;
            z-index: 40;
        }
        .mega-menu.open .mega-menu-panel,
        .mega-menu:hover .mega-menu-panel { opacity: 1; visibility: visible; transform: translate(-50%, 0); }
        .mega-row {
            display: flex; align-items: center; gap: 10px;
            padding: 7px 8px; border-radius: 6px;
            transition: background-color .2s ease;
        }
        .mega-row:hover { background-color: #fff; }
        .mega-icon-wrap {
            width: 2.5rem; height: 2.5rem; flex-shrink: 0;
            background: var(--clr-body);
            border: 1px solid var(--clr-border);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }
        .mega-icon { width: 1.25rem; height: 1.25rem; color: var(--clr-title); transition: color .4s ease; }
        .mega-row:hover .mega-icon { color: var(--clr-secondary); }

        @media (max-width: 1023px) {
            .mega-menu-panel {
                position: static; transform: none;
                min-width: 0; max-width: none;
                box-shadow: none; border: none; padding: 0 0 0 10px;
            }
            .mega-menu.open .mega-menu-panel { transform: none; }
        }

        .rw-page-head { background-color: #FAFAFA; border-bottom-left-radius: 26px; }
        .rw-card {
            background-color: #FAFAFA;
            border: 1px solid rgba(128, 128, 128, 0.25);
            border-radius: 6px;
        }
        .rw-list {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px;
            align-items: start;
        }
        .rw-list-icon {
            width: 2.5rem; height: 2.5rem; flex-shrink: 0;
            background: #F5F5F5;
            border: 1px solid rgba(128, 128, 128, 0.25);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }

        [data-aos] { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        [data-aos].aos-animate { opacity: 1; transform: translateY(0); }
        [data-aos-delay="100"] { transition-delay: 0.1s; }
        [data-aos-delay="200"] { transition-delay: 0.2s; }
        [data-aos-delay="300"] { transition-delay: 0.3s; }

        @keyframes wa-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
            50% { box-shadow: 0 0 0 16px rgba(34, 197, 94, 0); }
        }
        .wa-float { animation: wa-pulse 2s infinite; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col selection:bg-rose-200 selection:text-rose-900">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:bg-rose-600 focus:text-white focus:px-4 focus:py-2 focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-white">Langsung ke konten</a>
    <header class="sticky top-0 z-50">
        <div id="header-inner" class="header-inner bg-white/80 backdrop-blur-md border-b border-slate-200/60">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center gap-6 h-20 lg:h-24">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                        <img src="{{ asset('images/hero/logo_puri.png') }}" alt="Logo Puri Agung Permai RW12" class="w-12 h-12 md:w-14 md:h-14 object-contain">
                        <div class="hidden sm:block">
                            <span class="text-base md:text-lg font-bold text-slate-900 leading-tight block">Puri Agung Permai <span class="text-rose-600">RW12</span></span>
                            <span class="text-xs text-slate-500 hidden md:block">Kel. Gelam Jaya, Kec. Pasar Kemis</span>
                        </div>
                    </a>

                    <nav class="hidden lg:flex items-center gap-0.5" aria-label="Menu utama">
                        <a href="{{ route('home') }}" class="px-4 py-2 text-[15px] font-medium text-slate-700 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all {{ request()->routeIs('home') ? 'text-slate-900' : '' }}">Beranda</a>

                        <div class="mega-menu">
                            <button type="button" data-dropdown-toggle aria-expanded="false" aria-haspopup="true" class="px-4 py-2 text-[15px] font-medium text-slate-700 hover:text-rose-600 hover:bg-slate-50 rounded-lg inline-flex items-center gap-1.5 transition-all {{ request()->routeIs('jajaran-pengurus-rt') || request()->routeIs('profil') || request()->routeIs('struktur-rw') ? 'text-slate-900' : '' }}">
                                Tentang Kami
                                <i data-lucide="chevron-down" class="mega-chevron w-3.5 h-3.5"></i>
                            </button>
                            <div class="mega-menu-panel" role="menu">
                                <div class="space-y-0.5">
                                    <a href="{{ route('profil') }}" class="mega-row{{ request()->routeIs('profil') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="file-text" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Profil</span>
                                            <span class="text-xs text-slate-500">Visi misi serta informasi sekilas mengenai kami</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('struktur-rw') }}" class="mega-row{{ request()->routeIs('struktur-rw') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="network" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Struktur RW</span>
                                            <span class="text-xs text-slate-500">Struktur pengurus RW 12</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('jajaran-pengurus-rt') }}" class="mega-row{{ request()->routeIs('jajaran-pengurus-rt') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="users" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Jajaran Pengurus & RT</span>
                                            <span class="text-xs text-slate-500">Kenali lebih dekat RT anda</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('struktur-organisasi') }}" class="mega-row{{ request()->routeIs('struktur-organisasi') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="building" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Struktur Organisasi</span>
                                            <span class="text-xs text-slate-500">DKM, KARTAR, PKK, Posyandu</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mega-menu">
                            <button type="button" data-dropdown-toggle aria-expanded="false" aria-haspopup="true" class="px-4 py-2 text-[15px] font-medium text-slate-700 hover:text-rose-600 hover:bg-slate-50 rounded-lg inline-flex items-center gap-1.5 transition-all {{ request()->routeIs('layanan*') ? 'text-slate-900' : '' }}">
                                Layanan
                                <i data-lucide="chevron-down" class="mega-chevron w-3.5 h-3.5"></i>
                            </button>
                            <div class="mega-menu-panel" role="menu">
                                <div class="space-y-0.5">
                                    <a href="{{ route('layanan.administrasi-kependudukan') }}" class="mega-row{{ request()->routeIs('layanan.administrasi-kependudukan') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="folder-open" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Administrasi Kependudukan</span>
                                            <span class="text-xs text-slate-500">Jenis pelayanan administrasi warga</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('layanan.keamanan-wilayah') }}" class="mega-row{{ request()->routeIs('layanan.keamanan-wilayah') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="shield-check" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Keamanan Wilayah</span>
                                            <span class="text-xs text-slate-500">Fasilitas penunjang keamanan</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('layanan.kebersihan-lingkungan') }}" class="mega-row{{ request()->routeIs('layanan.kebersihan-lingkungan') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="leaf" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Kebersihan Lingkungan</span>
                                            <span class="text-xs text-slate-500">Jenis pelayanan kebersihan lingkungan</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mega-menu">
                            <button type="button" data-dropdown-toggle aria-expanded="false" aria-haspopup="true" class="px-4 py-2 text-[15px] font-medium text-slate-700 hover:text-rose-600 hover:bg-slate-50 rounded-lg inline-flex items-center gap-1.5 transition-all {{ request()->routeIs('pengumuman*') || request()->routeIs('kegiatan*') || request()->routeIs('statistik') || request()->routeIs('umkm*') ? 'text-slate-900' : '' }}">
                                Informasi
                                <i data-lucide="chevron-down" class="mega-chevron w-3.5 h-3.5"></i>
                            </button>
                            <div class="mega-menu-panel" role="menu">
                                <div class="space-y-0.5">
                                    <a href="{{ route('pengumuman') }}" class="mega-row" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="clipboard-list" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Berita</span>
                                            <span class="text-xs text-slate-500">Informasi terbaru untuk warga</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('kegiatan') }}" class="mega-row{{ request()->routeIs('kegiatan*') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="calendar-check" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Kegiatan</span>
                                            <span class="text-xs text-slate-500">Agenda dan acara RW</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('umkm') }}" class="mega-row{{ request()->routeIs('umkm*') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="store" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">UMKM</span>
                                            <span class="text-xs text-slate-500">Daftar usaha warga</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('statistik') }}" class="mega-row{{ request()->routeIs('statistik') ? ' bg-white ring-1 ring-rose-200' : '' }}" role="menuitem">
                                        <span class="mega-icon-wrap">
                                            <i data-lucide="pie-chart" class="mega-icon"></i>
                                        </span>
                                        <span class="flex flex-col gap-0.5 text-left">
                                            <span class="text-sm font-semibold text-slate-900">Statistik</span>
                                            <span class="text-xs text-slate-500">Statistik kependudukan</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('galeri') }}" class="px-4 py-2 text-[15px] font-medium text-slate-700 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all {{ request()->routeIs('galeri*') ? 'text-slate-900' : '' }}">Galeri</a>
                    </nav>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('search') }}" class="p-2 text-slate-600 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" aria-label="Cari">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </a>
                        <a href="https://wa.me/62895611487628" target="_blank" rel="noopener noreferrer" class="hidden xl:inline-flex items-center gap-2 bg-rose-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-rose-700 transition-all shadow-sm">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            Hubungi Kami
                        </a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700 transition-all shadow-sm">
                                <i data-lucide="layout-grid" class="w-4 h-4"></i>
                                Dashboard
                            </a>
                        @endauth
                        <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg" aria-label="Buka menu">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white">
                <div class="px-4 py-4 space-y-1 max-h-[70vh] overflow-y-auto">
                    <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-[15px] font-medium text-slate-700 hover:bg-slate-50 {{ request()->routeIs('home') ? 'text-slate-900' : '' }}">Beranda</a>

                    <a href="{{ route('search') }}" class="block px-3 py-2.5 rounded-lg text-[15px] font-medium text-slate-700 hover:bg-slate-50 {{ request()->routeIs('search') ? 'text-slate-900' : '' }}">
                        <span class="flex items-center gap-2"><i data-lucide="search" class="w-4 h-4"></i> Cari</span>
                    </a>

                    <div class="mobile-submenu">
                        <button type="button" onclick="toggleMobileSubmenu(this)" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-[15px] font-medium text-slate-700 hover:bg-slate-50 transition-colors {{ request()->routeIs('jajaran-pengurus-rt') || request()->routeIs('profil') || request()->routeIs('struktur-rw') ? 'text-slate-900' : '' }}">
                            <span>Tentang Kami</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-submenu-content overflow-hidden transition-all duration-300" style="max-height: 0;">
                            <div class="py-1 pl-4 space-y-0.5">
                                <a href="{{ route('profil') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('profil') ? 'text-rose-600 bg-rose-50' : '' }}">Profil</a>
                                <a href="{{ route('struktur-rw') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('struktur-rw') ? 'text-rose-600 bg-rose-50' : '' }}">Struktur RW</a>
                                <a href="{{ route('jajaran-pengurus-rt') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('jajaran-pengurus-rt') ? 'text-rose-600 bg-rose-50' : '' }}">Jajaran Pengurus & RT</a>
                                <a href="{{ route('struktur-organisasi') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('struktur-organisasi') ? 'text-rose-600 bg-rose-50' : '' }}">Struktur Organisasi</a>
                            </div>
                        </div>
                    </div>

                    <div class="mobile-submenu">
                        <button type="button" onclick="toggleMobileSubmenu(this)" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-[15px] font-medium text-slate-700 hover:bg-slate-50 transition-colors {{ request()->routeIs('layanan*') ? 'text-slate-900' : '' }}">
                            <span>Layanan</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-submenu-content overflow-hidden transition-all duration-300" style="max-height: 0;">
                            <div class="py-1 pl-4 space-y-0.5">
                                <a href="{{ route('layanan.administrasi-kependudukan') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('layanan.administrasi-kependudukan') ? 'text-rose-600 bg-rose-50' : '' }}">Administrasi Kependudukan</a>
                                <a href="{{ route('layanan.keamanan-wilayah') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('layanan.keamanan-wilayah') ? 'text-rose-600 bg-rose-50' : '' }}">Keamanan Wilayah</a>
                                <a href="{{ route('layanan.kebersihan-lingkungan') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('layanan.kebersihan-lingkungan') ? 'text-rose-600 bg-rose-50' : '' }}">Kebersihan Lingkungan</a>
                            </div>
                        </div>
                    </div>

                    <div class="mobile-submenu">
                        <button type="button" onclick="toggleMobileSubmenu(this)" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-[15px] font-medium text-slate-700 hover:bg-slate-50 transition-colors {{ request()->routeIs('pengumuman*') || request()->routeIs('kegiatan*') || request()->routeIs('statistik') || request()->routeIs('umkm*') ? 'text-slate-900' : '' }}">
                            <span>Informasi</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-submenu-content overflow-hidden transition-all duration-300" style="max-height: 0;">
                            <div class="py-1 pl-4 space-y-0.5">
                                <a href="{{ route('pengumuman') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('pengumuman*') ? 'text-rose-600 bg-rose-50' : '' }}">Berita</a>
                                <a href="{{ route('kegiatan') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('kegiatan*') ? 'text-rose-600 bg-rose-50' : '' }}">Kegiatan</a>
                                <a href="{{ route('umkm') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('umkm*') ? 'text-rose-600 bg-rose-50' : '' }}">UMKM</a>
                                <a href="{{ route('statistik') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik') ? 'text-rose-600 bg-rose-50' : '' }}">Statistik</a>
                                <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 {{ request()->routeIs('galeri*') ? 'text-rose-600 bg-rose-50' : '' }}">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 space-y-2">
                        <a href="https://wa.me/62895611487628" target="_blank" rel="noopener noreferrer" class="block px-3 py-2.5 rounded-lg text-sm font-medium bg-rose-600 text-white text-center hover:bg-rose-700">Hubungi Kami</a>

                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-rose-600 bg-rose-50 text-center">Dashboard</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="main-content" class="flex-1">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm" role="alert">
                    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/hero/logo_puri.png') }}" alt="Logo Puri Agung Permai RW12" class="w-10 h-10 object-contain">
                        <div>
                            <span class="text-base font-bold text-slate-900 block">Puri Agung Permai RW12</span>
                            <span class="text-xs text-slate-500">Kel. Gelam Jaya, Kec. Pasar Kemis</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">Portal informasi resmi warga Puri Agung Permai RW12, Kabupaten Tangerang, Banten.</p>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="https://youtube.com/@puriagungpermai" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 text-slate-500 hover:text-rose-600 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.546 12 3.546 12 3.546s-7.505 0-9.377.504A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.504 9.376.504 9.376.504s7.505 0 9.377-.504a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                <span>YouTube</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://tiktok.com/@puriagungpermai" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 text-slate-500 hover:text-rose-600 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9a6.33 6.33 0 0 0-.79-.05A6.34 6.34 0 0 0 3.15 15.3a6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V9.16a8.28 8.28 0 0 0 4.76 1.5v-3.4a4.85 4.85 0 0 1-1-.57z"/></svg>
                                <span>TikTok</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/puriagungpermai" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 text-slate-500 hover:text-rose-600 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                                <span>Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-4">Tentang Kami</h3>
                    <ul class="space-y-2.5 text-sm text-slate-500">
                        <li><a href="{{ route('profil') }}" class="hover:text-rose-600 transition-colors">Profil</a></li>
                        <li><a href="{{ route('struktur-rw') }}" class="hover:text-rose-600 transition-colors">Struktur RW</a></li>
                        <li><a href="{{ route('jajaran-pengurus-rt') }}" class="hover:text-rose-600 transition-colors">Jajaran Pengurus & RT</a></li>
                        <li><a href="{{ route('struktur-organisasi') }}" class="hover:text-rose-600 transition-colors">Struktur Organisasi</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-4">Layanan</h3>
                    <ul class="space-y-2.5 text-sm text-slate-500">
                        <li><a href="{{ route('layanan.administrasi-kependudukan') }}" class="hover:text-rose-600 transition-colors">Administrasi Kependudukan</a></li>
                        <li><a href="{{ route('layanan.keamanan-wilayah') }}" class="hover:text-rose-600 transition-colors">Keamanan Wilayah</a></li>
                        <li><a href="{{ route('layanan.kebersihan-lingkungan') }}" class="hover:text-rose-600 transition-colors">Kebersihan Lingkungan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-4">Informasi</h3>
                    <ul class="space-y-2.5 text-sm text-slate-500">
                        <li><a href="{{ route('pengumuman') }}" class="hover:text-rose-600 transition-colors">Berita</a></li>
                        <li><a href="{{ route('kegiatan') }}" class="hover:text-rose-600 transition-colors">Agenda Kegiatan</a></li>
                        <li><a href="{{ route('umkm') }}" class="hover:text-rose-600 transition-colors">UMKM</a></li>
                        <li><a href="{{ route('statistik') }}" class="hover:text-rose-600 transition-colors">Statistik</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-rose-600 transition-colors">Galeri</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-400">
                <p>&copy; {{ date('Y') }} RW12. Dikembangkan oleh KKN UYM Gelam Jaya 1</p>
                <a href="https://wa.me/62895611487628" target="_blank" rel="noopener noreferrer" class="hover:text-rose-600 transition-colors">Hubungi Kami</a>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp -->
    <a href="https://wa.me/62895611487628" target="_blank" rel="noopener noreferrer" class="wa-float fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" title="Hubungi RW12 via WhatsApp">
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        // Header scroll effect
        var headerInner = document.getElementById('header-inner');
        function onScroll() {
            if (window.scrollY > 10) {
                headerInner.classList.add('scrolled');
            } else {
                headerInner.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        // Mega menu dropdown
        function closeAllMega() {
            document.querySelectorAll('.mega-menu.open').forEach(function(m) {
                m.classList.remove('open');
                var btn = m.querySelector('[data-dropdown-toggle]');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            });
        }
        document.querySelectorAll('[data-dropdown-toggle]').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var item = btn.closest('.mega-menu');
                var willOpen = !item.classList.contains('open');
                closeAllMega();
                if (willOpen) {
                    item.classList.add('open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            });
        });
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.mega-menu')) closeAllMega();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAllMega();
        });

        // Mobile menu
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });

        // Mobile submenu accordion
        function toggleMobileSubmenu(btn) {
            var content = btn.nextElementSibling;
            var icon = btn.querySelector('[data-lucide]');
            var isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
            if (isOpen) {
                content.style.maxHeight = '0px';
                if (icon) icon.style.transform = '';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                if (icon) icon.style.transform = 'rotate(180deg)';
            }
        }

        // Scroll Animation (AOS-like)
        document.addEventListener('DOMContentLoaded', function() {
            var aosElements = document.querySelectorAll('[data-aos]');
            var aosObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('aos-animate');
                        aosObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            aosElements.forEach(function(el) { aosObserver.observe(el); });
        });

        // Count-up Animation
        document.addEventListener('DOMContentLoaded', function() {
            var countEls = document.querySelectorAll('[data-count]');
            var countObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var el = entry.target;
                        var target = parseInt(el.dataset.count);
                        if (isNaN(target)) return;
                        var current = 0;
                        var increment = Math.ceil(target / 40);
                        var timer = setInterval(function() {
                            current += increment;
                            if (current >= target) {
                                el.textContent = target.toLocaleString('id-ID');
                                clearInterval(timer);
                            } else {
                                el.textContent = current.toLocaleString('id-ID');
                            }
                        }, 30);
                        countObserver.unobserve(el);
                    }
                });
            }, { threshold: 0.5 });

            countEls.forEach(function(el) { countObserver.observe(el); });
        });
    </script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
</body>
</html>
