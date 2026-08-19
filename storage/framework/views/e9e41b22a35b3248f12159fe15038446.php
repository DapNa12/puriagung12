<?php $__env->startSection('title', 'UMKM Warga'); ?>
<?php $__env->startSection('meta_description', 'Daftar Usaha Mikro Kecil dan Menengah (UMKM) warga Puri Agung Permai RW12. Temukan usaha lokal di lingkungan Anda.'); ?>
<?php $__env->startSection('og_title', 'UMKM Warga - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Daftar UMKM warga Puri Agung Permai RW12. Dukung usaha lokal lingkungan Anda.'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">UMKM Warga</h1>
        <p class="text-slate-500 mt-2">Temukan dan dukung usaha lokal warga Puri Agung Permai RW12</p>
    </div>

    <form method="GET" class="bg-white p-4 md:p-6 rounded-2xl border border-slate-200 shadow-sm mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-96">
            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama usaha atau pemilik..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 text-sm text-slate-800 focus:outline-none focus:border-rose-500 focus:bg-white transition-all shadow-inner">
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5"></i>
        </div>

        <div class="flex flex-wrap md:flex-nowrap items-center gap-3 w-full md:w-auto">
            <select name="kategori" onchange="this.form.submit()" class="w-full md:w-48 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 font-medium focus:outline-none focus:border-rose-500 focus:bg-white transition-all">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $daftarKategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($kat); ?>" <?php if(request('kategori') == $kat): echo 'selected'; endif; ?>><?php echo e($kat); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <?php if(request('search') || request('kategori')): ?>
            <a href="<?php echo e(route('umkm')); ?>" class="px-4 py-3 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors shrink-0">
                Reset Filter
            </a>
            <?php endif; ?>
        </div>
    </form>

    <?php if($umkm->count() > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $umkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('umkm.show', $item->slug)); ?>" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            <div class="relative h-48 overflow-hidden">
                <?php if($item->foto): ?>
                <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <i data-lucide="store" class="w-12 h-12 text-rose-300"></i>
                </div>
                <?php endif; ?>
                <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold px-2.5 py-1 rounded-lg">
                    <?php echo e($item->kategori); ?>

                </span>
            </div>
            <div class="p-5">
                <h2 class="font-bold text-slate-900 mb-1 group-hover:text-rose-600 transition-colors"><?php echo e($item->nama); ?></h2>
                <p class="text-xs text-slate-500 mb-2">Pemilik: <?php echo e($item->nama_pemilik); ?></p>
                <p class="text-sm text-slate-600 line-clamp-2"><?php echo e(Str::limit($item->deskripsi, 100)); ?></p>
                <div class="flex items-center gap-3 mt-3 text-xs text-slate-400">
                    <?php if($item->jam_operasional): ?>
                    <span class="flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        <?php echo e($item->jam_operasional); ?>

                    </span>
                    <?php endif; ?>
                    <span class="flex items-center gap-1">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                        RT <?php echo e($item->rt); ?>

                    </span>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($umkm->hasPages()): ?>
    <div class="mt-8">
        <?php echo e($umkm->onEachSide(1)->links()); ?>

    </div>
    <?php endif; ?>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="store" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada UMKM</p>
        <p class="text-slate-400 text-sm mt-1">Data UMKM warga akan tampil di sini.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\umkm.blade.php ENDPATH**/ ?>