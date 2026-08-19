<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative overflow-hidden bg-gradient-to-br from-rose-800 via-rose-700 to-rose-900">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNCI+PHBhdGggZD0iTTM2IDM0djItSDI0di0yaDEyek0zNiAyNHYySDI0di0yaDEyeiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-20 md:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white/90 text-sm px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 bg-rose-400 rounded-full animate-pulse"></span>
                Sistem Informasi Puri Agung Permai RW12
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Selamat Datang di<br>
                <span class="text-rose-300">Puri Agung Permai RW12</span>
            </h1>
            <p class="text-lg md:text-xl text-rose-100/80 max-w-2xl mx-auto mb-10 leading-relaxed">
                Kelurahan Gelam Jaya, Kecamatan Pasar Kemis, Kabupaten Tangerang, Banten — memudahkan akses informasi dan pengelolaan data warga secara digital.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e(route('pengumuman')); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-rose-800 px-8 py-3 rounded-xl font-semibold hover:bg-rose-50 transition-all shadow-lg shadow-rose-900/20">
                    <i data-lucide="megaphone" class="w-5 h-5"></i>
                    Lihat Pengumuman
                </a>
                <a href="<?php echo e(route('kegiatan')); ?>" class="inline-flex items-center justify-center gap-2 bg-rose-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-rose-500 transition-all border border-rose-400/30 shadow-lg shadow-rose-900/20">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Jadwal Kegiatan
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 -mt-10 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 text-center">
            <div class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="users" class="w-6 h-6 text-rose-600"></i>
            </div>
            <div class="text-3xl font-bold text-gray-900"><?php echo e($totalWarga); ?></div>
            <div class="text-gray-500 mt-1">Warga Terdaftar</div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 text-center">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="newspaper" class="w-6 h-6 text-blue-600"></i>
            </div>
            <div class="text-3xl font-bold text-gray-900"><?php echo e($pengumuman->count()); ?></div>
            <div class="text-gray-500 mt-1">Pengumuman Aktif</div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 text-center">
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="calendar" class="w-6 h-6 text-amber-600"></i>
            </div>
            <div class="text-3xl font-bold text-gray-900"><?php echo e($kegiatan->count()); ?></div>
            <div class="text-gray-500 mt-1">Kegiatan Mendatang</div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <?php if($pengumuman->count()): ?>
    <div class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Pengumuman Terbaru</h2>
                <p class="text-gray-500 mt-1">Informasi terkini seputar Puri Agung Permai RW12</p>
            </div>
            <a href="<?php echo e(route('pengumuman')); ?>" class="text-rose-600 hover:text-rose-700 font-medium text-sm hidden sm:block">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('pengumuman.show', $item)); ?>" class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 p-6 transition-all duration-200">
                <div class="flex items-center gap-2 text-xs text-gray-400 mb-3">
                    <span><?php echo e($item->created_at->isoFormat('D MMMM Y')); ?></span>
                    <span>&middot;</span>
                    <span><?php echo e($item->user->name ?? 'Admin'); ?></span>
                </div>
                <h3 class="font-bold text-gray-900 group-hover:text-rose-700 transition-colors mb-2"><?php echo e($item->judul); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed"><?php echo e(Str::limit($item->isi, 120)); ?></p>
                <span class="inline-flex items-center gap-1 text-rose-600 text-sm font-medium mt-3 group-hover:gap-2 transition-all">Baca selengkapnya &rarr;</span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a href="<?php echo e(route('pengumuman')); ?>" class="text-rose-600 hover:text-rose-700 font-medium text-sm mt-4 inline-block sm:hidden">Lihat semua pengumuman &rarr;</a>
    </div>
    <?php endif; ?>

    <?php if($kegiatan->count()): ?>
    <div>
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Kegiatan Mendatang</h2>
                <p class="text-gray-500 mt-1">Agenda dan acara Puri Agung Permai RW12</p>
            </div>
            <a href="<?php echo e(route('kegiatan')); ?>" class="text-rose-600 hover:text-rose-700 font-medium text-sm hidden sm:block">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 bg-rose-50 rounded-xl flex flex-col items-center justify-center flex-shrink-0">
                        <span class="text-lg font-bold text-rose-700 leading-none"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d')); ?></span>
                        <span class="text-xs text-rose-600 font-medium"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('MMM')); ?></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 mb-1"><?php echo e($item->nama_kegiatan); ?></h3>
                        <div class="flex flex-wrap gap-3 text-sm text-gray-500">
                            <?php if($item->waktu): ?><span class="flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i><?php echo e($item->waktu); ?></span><?php endif; ?>
                            <?php if($item->tempat): ?><span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-4 h-4"></i><?php echo e($item->tempat); ?></span><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="mt-16 text-center bg-gradient-to-r from-rose-50 to-rose-100 rounded-2xl p-8 md:p-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Butuh Bantuan?</h2>
        <p class="text-gray-600 mb-6 max-w-lg mx-auto">Hubungi pengurus Puri Agung Permai RW12 untuk informasi lebih lanjut.</p>
        <a href="<?php echo e(route('pengurus-rt')); ?>" class="inline-flex items-center gap-2 bg-rose-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-rose-500 transition-all shadow-lg shadow-rose-200">
            <i data-lucide="user" class="w-5 h-5"></i>
            Lihat Pengurus RT
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\welcome.blade.php ENDPATH**/ ?>