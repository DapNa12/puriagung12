<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('images/hero/logo_puri.png')); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Admin Puri Agung Permai RW12</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        #sidebar { width: 256px; transition: width 0.25s ease; }
        html.sb-collapsed #sidebar { width: 64px; }

        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 1rem; font-size: 0.875rem; font-weight: 500; color: #475569; border-radius: 0.5rem; transition: all 0.15s ease; position: relative; white-space: nowrap; }
        .sidebar-link:hover { background-color: #f8fafc; }
        .sidebar-link.active { background-color: #f8fafc; color: #BE123C; font-weight: 600; }
        .sidebar-link.active::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 0.25rem; height: 1.25rem; background-color: #E11D48; border-radius: 0 9999px 9999px 0; }

        html.sb-collapsed #sidebar .sidebar-link { justify-content: center; padding: 0; margin-inline: auto; width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; }
        html.sb-collapsed #sidebar .sidebar-link span { display: none; }
        html.sb-collapsed #sidebar .section-label { display: none; }
        html.sb-collapsed #sidebar .sidebar-org { display: none; }
        html.sb-collapsed #sidebar .sidebar-hamburger { display: none; }
        html.sb-collapsed #sidebar .user-info-text { display: none; }
        html.sb-collapsed #sidebar .user-actions-text { display: none; }
        html.sb-collapsed #sidebar .collapse-btn { display: none; }
        html.sb-collapsed #sidebar #sidebar-logo-link { cursor: pointer; }
        html.sb-collapsed #sidebar .user-section { padding: 0.75rem 0; display: flex; flex-direction: column; align-items: center; }
        html.sb-collapsed #sidebar .user-info { padding: 0; gap: 0; flex-direction: column; align-items: center; }
        html.sb-collapsed #sidebar .user-actions { flex-direction: column; align-items: center; padding: 0; border: none; margin-top: 0.5rem; gap: 0.25rem; }
html.sb-collapsed #sidebar .user-actions a,
html.sb-collapsed #sidebar .user-actions button { width: 2.75rem; height: 2.75rem; padding: 0; justify-content: center; border-radius: 0.75rem; position: relative; }
        html.sb-collapsed #sidebar .user-actions form { display: flex; justify-content: center; }
        html.sb-collapsed #sidebar .user-actions a svg,
        html.sb-collapsed #sidebar .user-actions button svg,
        html.sb-collapsed #sidebar .user-actions a i svg,
        html.sb-collapsed #sidebar .user-actions button i svg { width: 1.125rem; height: 1.125rem; }
        html.sb-collapsed #sidebar .sidebar-nav { padding: 1rem 0.5rem; }
        html.sb-collapsed #sidebar .sidebar-header { justify-content: center; padding: 0; }

        /* Tooltips for collapsed sidebar */
        html.sb-collapsed #sidebar .sidebar-link::after,
        html.sb-collapsed #sidebar .user-actions a::after,
        html.sb-collapsed #sidebar .user-actions button::after { content: attr(data-title); position: absolute; left: calc(100% + 0.75rem); top: 50%; transform: translateY(-50%); padding: 0.375rem 0.75rem; background-color: #1e293b; color: #fff; font-size: 0.75rem; font-weight: 500; border-radius: 0.375rem; white-space: nowrap; opacity: 0; visibility: hidden; transition: all 0.2s ease; z-index: 50; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); pointer-events: none; }
        html.sb-collapsed #sidebar .sidebar-link:hover::after,
        html.sb-collapsed #sidebar .user-actions a:hover::after,
        html.sb-collapsed #sidebar .user-actions button:hover::after { opacity: 1; visibility: visible; }

        .card-hover { transition: all 0.2s ease; }
        .card-hover:hover { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1); }

        .btn-primary { display: inline-flex; align-items: center; gap: 0.5rem; background-color: #E11D48; color: #fff; padding: 0.625rem 1rem; border-radius: 0.75rem; font-size: 0.875rem; font-weight: 500; transition: all 0.15s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn-primary:hover { background-color: #BE123C; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1); }

        .btn-secondary { display: inline-flex; align-items: center; gap: 0.5rem; background-color: #fff; border: 1px solid #e2e8f0; color: #334155; padding: 0.625rem 1rem; border-radius: 0.75rem; font-size: 0.875rem; font-weight: 500; transition: all 0.15s ease; }
        .btn-secondary:hover { background-color: #f8fafc; }

        .btn-soft-blue { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 500; color: #2563eb; background-color: #eff6ff; border-radius: 0.5rem; transition: all 0.15s ease; }
        .btn-soft-blue:hover { background-color: #dbeafe; }

        .btn-soft-yellow { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 500; color: #d97706; background-color: #fffbeb; border-radius: 0.5rem; transition: all 0.15s ease; }
        .btn-soft-yellow:hover { background-color: #fef3c7; }

        .btn-soft-red { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 500; color: #dc2626; background-color: #fef2f2; border-radius: 0.5rem; transition: all 0.15s ease; }
        .btn-soft-red:hover { background-color: #fee2e2; }

        .input-field { width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.625rem 1rem; font-size: 0.875rem; color: #334155; transition: all 0.15s ease; }
        .input-field::placeholder { color: #94a3b8; }
        .input-field:focus { outline: none; border-color: #0ea5e9; ring: 2px solid #0ea5e9; box-shadow: 0 0 0 2px rgba(14,165,233,0.4); }

        .input-error { border-color: #f87171; box-shadow: 0 0 0 1px #f87171; }

        .badge { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; }
        .badge-dot { width: 0.375rem; height: 0.375rem; border-radius: 9999px; }

        .section-label { padding: 0 1rem; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.12em; }
    </style>
    <script>if(localStorage.getItem('sidebar-collapsed')==='true')document.documentElement.classList.add('sb-collapsed')</script>
</head>
<body class="bg-slate-50 h-screen flex overflow-hidden">
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-50 bg-white border-r border-slate-200 flex flex-col transform -translate-x-full md:translate-x-0 transition-all duration-300 h-screen flex-shrink-0">
        <div class="sidebar-header h-16 flex items-center border-b border-slate-100 px-4 gap-3 flex-shrink-0">
            <a href="<?php echo e(route('admin.dashboard')); ?>" id="sidebar-logo-link" class="sidebar-logo flex items-center gap-2.5 min-w-0 flex-1">
                <img src="<?php echo e(asset('images/hero/logo_puri.png')); ?>" alt="Logo Puri Agung Permai RW12" class="w-8 h-8 flex-shrink-0 object-contain">
                <div class="sidebar-org min-w-0">
                    <div class="text-sm font-bold text-slate-900 leading-tight truncate">Puri Agung Permai</div>
                    <div class="text-[10px] font-semibold text-rose-600 leading-tight">RW12</div>
                </div>
            </a>
            <button id="collapse-btn" class="collapse-btn w-7 h-7 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center flex-shrink-0 transition-all hidden md:flex" title="Ciutkan sidebar">
                <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-500 transition-transform duration-200"></i>
            </button>
            <button id="sidebar-close-btn" class="md:hidden w-7 h-7 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center flex-shrink-0 transition-all" title="Tutup menu">
                <i data-lucide="x" class="w-3.5 h-3.5 text-slate-500"></i>
            </button>
        </div>

        <div class="flex-1 min-h-0 overflow-y-auto">
            <nav class="sidebar-nav px-3 py-4 space-y-1">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" data-title="Beranda">
                <i data-lucide="home" class="w-5 h-5 flex-shrink-0"></i>
                <span>Beranda</span>
            </a>

            <?php $role = auth()->user()?->role ?? 'guest'; ?>

            <?php if(in_array($role, ['admin', 'sekretaris'])): ?>
            <div class="pt-5 pb-2">
                <p class="section-label">Master Data</p>
            </div>
            <a href="<?php echo e(route('admin.statistik.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.statistik*') ? 'active' : ''); ?>" data-title="Statistik Kependudukan">
                <i data-lucide="bar-chart-3" class="w-5 h-5 flex-shrink-0"></i>
                <span>Statistik</span>
            </a>
            <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.pengurus*') ? 'active' : ''); ?>" data-title="Pengurus RW">
                <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
                <span>Pengurus RW</span>
            </a>
            <a href="<?php echo e(route('admin.umkm.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.umkm*') ? 'active' : ''); ?>" data-title="UMKM">
                <i data-lucide="store" class="w-5 h-5 flex-shrink-0"></i>
                <span>UMKM</span>
            </a>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>" data-title="Kelola User">
                <i data-lucide="users" class="w-5 h-5 flex-shrink-0"></i>
                <span>Kelola User</span>
            </a>

            <div class="pt-5 pb-2">
                <p class="section-label">Informasi & Log</p>
            </div>
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.berita*') ? 'active' : ''); ?>" data-title="Berita">
                <i data-lucide="megaphone" class="w-5 h-5 flex-shrink-0"></i>
                <span>Berita</span>
            </a>
            <a href="<?php echo e(route('admin.galeri.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.galeri*') ? 'active' : ''); ?>" data-title="Galeri">
                <i data-lucide="camera" class="w-5 h-5 flex-shrink-0"></i>
                <span>Galeri</span>
            </a>
            <a href="<?php echo e(route('admin.activity-log.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.activity-log*') ? 'active' : ''); ?>" data-title="Log Aktivitas">
                <i data-lucide="history" class="w-5 h-5 flex-shrink-0"></i>
                <span>Log Aktivitas</span>
            </a>
            <?php endif; ?>
            </nav>
        </div>

        <div class="user-section border-t border-slate-100 p-3 flex-shrink-0">
            <div class="flex items-center gap-3 px-3 py-2.5 user-info">
                <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-semibold text-rose-700"><?php echo e(substr(Auth::user()?->name ?? '', 0, 1)); ?></span>
                </div>
                <div class="user-info-text flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate"><?php echo e(Auth::user()?->name ?? '-'); ?></p>
                    <p class="text-xs text-slate-500 truncate capitalize"><?php echo e(Auth::user()?->role ?? '-'); ?></p>
                </div>
            </div>
            <div class="user-actions mt-1 flex border-t border-slate-100 pt-2">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all w-full" data-title="Ke Website">
                    <i data-lucide="arrow-left" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="user-actions-text">Website</span>
                </a>
            </div>
        </div>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/30 z-40 hidden md:hidden"></div>

    <div id="main-content" class="flex-1 flex flex-col min-w-0 transition-all duration-300 overflow-y-auto">
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm h-14 flex items-center px-4 md:px-6 sticky top-0 z-40">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-3">
                    <button id="sidebar-toggle" class="md:hidden w-9 h-9 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center transition-all">
                        <i id="toggle-icon-open" data-lucide="menu" class="w-4 h-4 text-slate-600"></i>
                        <i id="toggle-icon-close" data-lucide="x" class="w-4 h-4 text-slate-600 hidden"></i>
                    </button>
                    <h1 class="text-base md:text-lg font-bold text-slate-900"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 rounded-full border border-emerald-200">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        <span class="text-xs font-medium text-emerald-700 hidden sm:inline">Aktif</span>
                    </div>
                    <div class="relative flex items-center gap-2.5 pl-3 border-l border-slate-200">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-medium text-slate-900 leading-tight"><?php echo e(Auth::user()?->name ?? '-'); ?></p>
                            <p class="text-[10px] text-slate-500 capitalize leading-tight"><?php echo e(Auth::user()?->role ?? '-'); ?></p>
                        </div>
                        <button id="user-dropdown-btn" type="button" class="w-9 h-9 bg-gradient-to-br from-rose-500 to-rose-700 rounded-full flex items-center justify-center shadow-sm flex-shrink-0 hover:from-rose-600 hover:to-rose-800 transition-all cursor-pointer focus:outline-none" title="Menu pengguna">
                            <span class="text-xs md:text-sm font-semibold text-white"><?php echo e(substr(Auth::user()?->name ?? '', 0, 1)); ?></span>
                        </button>
                        <div id="user-dropdown" class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-200 py-2 hidden z-50">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-medium text-slate-900"><?php echo e(Auth::user()?->name ?? '-'); ?></p>
                                <p class="text-xs text-slate-500 capitalize"><?php echo e(Auth::user()?->role ?? '-'); ?></p>
                            </div>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:text-red-600 hover:bg-red-50 transition-all">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-6 lg:p-8">
            <?php if(session('success')): ?>
                <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert">
                    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert">
                    <i data-lucide="x-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const toggleIconOpen = document.getElementById('toggle-icon-open');
        const toggleIconClose = document.getElementById('toggle-icon-close');
        const collapseBtn = document.getElementById('collapse-btn');
        const sidebarCloseBtn = document.getElementById('sidebar-close-btn');
        const logoLink = document.getElementById('sidebar-logo-link');

        const savedState = localStorage.getItem('sidebar-collapsed');
        if (savedState === 'true' && window.innerWidth >= 768) {
            document.documentElement.classList.add('sb-collapsed');
        }

        function toggleCollapse() {
            document.documentElement.classList.toggle('sb-collapsed');
            const isCollapsed = document.documentElement.classList.contains('sb-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
        }

        collapseBtn?.addEventListener('click', toggleCollapse);

        logoLink?.addEventListener('click', function(e) {
            if (document.documentElement.classList.contains('sb-collapsed')) {
                e.preventDefault();
                toggleCollapse();
            }
        });

        function isMobile() { return window.innerWidth < 768; }

        function syncToggleIcon(open) {
            if (toggleIconOpen && toggleIconClose) {
                toggleIconOpen.classList.toggle('hidden', open);
                toggleIconClose.classList.toggle('hidden', !open);
            }
        }

        function setMobileSidebar(open) {
            if (!isMobile()) return;
            const willOpen = open !== undefined ? open : !sidebar.classList.contains('-translate-x-full');
            sidebar.classList.toggle('-translate-x-full', !willOpen);
            overlay.classList.toggle('hidden', !willOpen);
            syncToggleIcon(willOpen);
        }

        toggleBtn?.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isMobile()) {
                const opening = sidebar.classList.contains('-translate-x-full');
                setMobileSidebar(opening);
            }
        });

        sidebarCloseBtn?.addEventListener('click', function() {
            setMobileSidebar(false);
        });

        overlay?.addEventListener('click', function() {
            setMobileSidebar(false);
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMobile() && !sidebar.classList.contains('-translate-x-full')) {
                setMobileSidebar(false);
            }
        });

        window.addEventListener('resize', function() {
            if (!isMobile()) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                syncToggleIcon(false);
                document.documentElement.classList.remove('sb-collapsed');
            }
        });

        const dropdownBtn = document.getElementById('user-dropdown-btn');
        const dropdown = document.getElementById('user-dropdown');

        if (dropdownBtn && dropdown) {
            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!dropdown.classList.contains('hidden') && !dropdown.contains(e.target) && e.target !== dropdownBtn && !dropdownBtn.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            });
        }

    </script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
</body>
</html><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/layouts/admin.blade.php ENDPATH**/ ?>