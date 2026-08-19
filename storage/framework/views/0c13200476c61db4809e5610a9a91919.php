<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Selamat datang, <?php echo e(Auth::user()->name); ?>!</h1>
        <p class="text-slate-500 mt-1">Inilah ringkasan data & statistik Puri Agung Permai RW12 hari ini.</p>
    </div>
    <?php if(in_array($role, ['admin', 'sekretaris'])): ?>
    <div class="flex flex-wrap gap-3">
        <a href="<?php echo e(route('admin.berita.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold shadow-sm transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            + Tambah Berita Baru
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- Kartu Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <?php if(in_array($role, ['admin', 'sekretaris'])): ?>
    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Warga</span>
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-rose-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($totalWarga); ?></div>
        <div class="text-sm text-slate-500 mt-1">Jiwa (statistik manual)</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Kegiatan</span>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i data-lucide="calendar" class="w-5 h-5 text-emerald-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($totalKegiatan); ?></div>
        <div class="flex items-center gap-3 mt-1">
            <span class="text-sm text-slate-500"><?php echo e($kegiatanSelesai); ?> selesai</span>
            <?php if($kegiatanMendatang > 0): ?>
            <span class="text-sm text-amber-600 font-medium"><?php echo e($kegiatanMendatang); ?> mendatang</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total User System</span>
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($totalUsers); ?></div>
        <div class="text-sm text-slate-500 mt-1">Pengelola & Admin</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Informasi Publik</span>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <i data-lucide="megaphone" class="w-5 h-5 text-amber-600"></i>
            </div>
        </div>
        <div class="space-y-2.5">
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Pengumuman aktif</span>
                <span class="font-bold text-slate-900"><?php echo e($pengumumanAktif); ?></span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Kegiatan mendatang</span>
                <span class="font-bold text-slate-900"><?php echo e($kegiatanMendatang); ?></span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Kegiatan selesai</span>
                <span class="font-bold text-slate-900"><?php echo e($kegiatanSelesai); ?></span>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Pengumuman Aktif</span>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <i data-lucide="megaphone" class="w-5 h-5 text-amber-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($pengumumanAktif); ?></div>
        <div class="text-sm text-slate-500 mt-1"><?php echo e($pengumumanAktif > 0 ? 'Sedang tayang' : 'Tidak ada'); ?></div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kegiatan Mendatang</span>
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <i data-lucide="calendar" class="w-5 h-5 text-rose-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($kegiatanMendatang); ?></div>
        <div class="text-sm text-slate-500 mt-1">Akan datang</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kegiatan Selesai</span>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($kegiatanSelesai); ?></div>
        <div class="text-sm text-slate-500 mt-1">Telah dilaksanakan</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Pengurus</span>
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900"><?php echo e($totalPengurus); ?></div>
        <div class="text-sm text-slate-500 mt-1">Pengurus aktif</div>
    </div>
    <?php endif; ?>
</div>

<?php if(in_array($role, ['admin', 'sekretaris'])): ?>
<!-- Kelola Cepat -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Pengaturan Statistik RW & Bangunan</h3>
                <p class="text-xs text-slate-500 mt-0.5">Update statistik jumlah rumah & bangunan yang tampil live di halaman publik.</p>
            </div>
            <a href="<?php echo e(route('admin.statistik.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all shadow-sm flex-shrink-0">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                Kelola Statistik
            </a>
        </div>
        <form action="<?php echo e(route('admin.statistik-rw.update')); ?>" method="POST" class="mt-4 flex flex-col sm:flex-row sm:items-center gap-3">
            <?php echo csrf_field(); ?>
            <div class="flex-1">
                <input type="number" name="jumlah_rumah_bangunan" value="<?php echo e(old('jumlah_rumah_bangunan', $statistikRw->jumlah_rumah_bangunan ?? 0)); ?>" class="input-field py-2 text-sm" min="0" placeholder="Jumlah rumah">
            </div>
            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm flex-shrink-0">Simpan Jumlah Rumah</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Struktur Pengurus</h3>
                <p class="text-xs text-slate-500 mt-0.5">Kelola struktur kepengurusan RT &amp; RW yang tampil live di halaman publik.</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="<?php echo e(route('admin.pengurus.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah
                </a>
                <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-all shadow-sm">
                    Kelola (<?php echo e($totalPengurus); ?>)
                </a>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
            <?php $__empty_1 = true; $__currentLoopData = $pengurusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3">
                <p class="text-sm font-semibold text-slate-900 truncate"><?php echo e($p->nama ?? '-'); ?></p>
                <p class="text-xs text-slate-500 mt-0.5"><?php echo e($p->rt ? 'RT '.$p->rt.' · ' : ''); ?><?php echo e($p->jabatan); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-sm text-slate-400 sm:col-span-2">Belum ada pengurus. Klik "Tambah" untuk memulai.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Grafik & Aksi Cepat -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Jumlah Warga per RT</h2>
            <span class="text-xs text-slate-400">Total <?php echo e($totalWarga); ?> jiwa</span>
        </div>
        <div class="space-y-3">
            <?php $__currentLoopData = $wargaPerRt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="font-medium text-slate-700">RT <?php echo e($rt->rt); ?></span>
                    <span class="text-slate-500"><?php echo e($rt->total); ?> jiwa</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full transition-all" style="width: <?php echo e(($rt->total / $maxRt) * 100); ?>%"></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-3 text-center">
            <div>
                <p class="text-xl font-bold text-slate-900"><?php echo e($wargaLaki); ?></p>
                <p class="text-xs text-slate-500">Laki-laki</p>
            </div>
            <div>
                <p class="text-xl font-bold text-slate-900"><?php echo e($wargaPerempuan); ?></p>
                <p class="text-xs text-slate-500">Perempuan</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900">Aksi Cepat</h2>
                <span class="text-xs text-slate-400">Menu Pengelola</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <a href="<?php echo e(route('admin.statistik.index')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-emerald-300 hover:bg-emerald-50 transition-all">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Statistik</span>
                </a>
                <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-rose-300 hover:bg-rose-50 transition-all">
                    <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola Pengumuman</span>
                </a>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola User</span>
                </a>
                <a href="<?php echo e(route('admin.berita.index')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-amber-300 hover:bg-amber-50 transition-all">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Berita</span>
                </a>
                <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-violet-300 hover:bg-violet-50 transition-all">
                    <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center text-violet-600">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola Pengurus</span>
                </a>
                <a href="<?php echo e(route('admin.galeri.index')); ?>" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-rose-300 hover:bg-rose-50 transition-all">
                    <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Galeri</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<!-- Informasi Terbaru (Ketua RW) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Pengumuman Terbaru</h2>
            <a href="<?php echo e(route('pengumuman')); ?>" class="text-xs text-rose-600 hover:text-rose-700 font-medium">Lihat Semua</a>
        </div>
        <?php if($recentPengumuman->count() > 0): ?>
        <div class="space-y-3">
            <?php $__currentLoopData = $recentPengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="megaphone" class="w-4 h-4 text-amber-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate"><?php echo e($p->judul); ?></p>
                    <p class="text-xs text-slate-500"><?php echo e($p->tgl_mulai ? \Carbon\Carbon::parse($p->tgl_mulai)->isoFormat('D MMMM Y') : '-'); ?></p>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded-full <?php echo e($p->status === 'aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600'); ?>">
                    <span class="w-1 h-1 rounded-full <?php echo e($p->status === 'aktif' ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                    <?php echo e($p->status === 'aktif' ? 'Aktif' : 'Nonaktif'); ?>

                </span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-6">
            <p class="text-slate-400 text-sm">Belum ada pengumuman.</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Kegiatan Terbaru</h2>
            <a href="<?php echo e(route('kegiatan')); ?>" class="text-xs text-rose-600 hover:text-rose-700 font-medium">Lihat Semua</a>
        </div>
        <?php if($recentKegiatan->count() > 0): ?>
        <div class="space-y-3">
            <?php $__currentLoopData = $recentKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="calendar" class="w-4 h-4 text-rose-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate"><?php echo e($k->nama_kegiatan); ?></p>
                    <p class="text-xs text-slate-500"><?php echo e($k->tanggal ? \Carbon\Carbon::parse($k->tanggal)->isoFormat('D MMMM Y') : '-'); ?></p>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded-full <?php echo e($k->status === 'akan_datang' ? 'bg-amber-50 text-amber-700' : ($k->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700')); ?>">
                    <span class="w-1 h-1 rounded-full <?php echo e($k->status === 'akan_datang' ? 'bg-amber-500' : ($k->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500')); ?>"></span>
                    <?php echo e($k->status === 'akan_datang' ? 'Akan Datang' : ucfirst($k->status)); ?>

                </span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-6">
            <p class="text-slate-400 text-sm">Belum ada kegiatan.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>