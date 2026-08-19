<?php $__env->startSection('title', 'Berita dan Pengumuman'); ?>
<?php $__env->startSection('meta_description', 'Berita dan pengumuman terkini dari Puri Agung Permai RW12. Informasi penting seputar lingkungan warga.'); ?>
<?php $__env->startSection('og_title', 'Berita dan Pengumuman - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Berita dan pengumuman terkini dari Puri Agung Permai RW12.'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header Section -->
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-rose-100 text-rose-800 rounded-full text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse" aria-hidden="true"></span> Informasi Terkini RW 12
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Berita &amp; Informasi</h1>
            <p class="mt-3 text-slate-600 text-base md:text-lg">Baca berita, agenda kegiatan, dan informasi penting seputar lingkungan Puri Agung Permai RW 12.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Filter & Search Controls (Inspired by rw-12.id) -->
    <form method="GET" action="<?php echo e(route('pengumuman')); ?>" class="bg-white p-4 md:p-6 rounded-2xl border border-slate-200 shadow-sm mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-96">
            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari berita atau pengumuman..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 text-sm text-slate-800 focus:outline-none focus:border-rose-500 focus:bg-white transition-all shadow-inner">
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5"></i>
        </div>

        <div class="flex flex-wrap md:flex-nowrap items-center gap-3 w-full md:w-auto">
            <select name="kategori" onchange="this.form.submit()" class="w-full md:w-48 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 font-medium focus:outline-none focus:border-rose-500 focus:bg-white transition-all">
                <option value="">Semua Kategori</option>
                <option value="kegiatan" <?php echo e(request('kategori') == 'kegiatan' ? 'selected' : ''); ?>>Kegiatan</option>
                <option value="pemberitahuan" <?php echo e(request('kategori') == 'pemberitahuan' ? 'selected' : ''); ?>>Pemberitahuan</option>
            </select>

            <?php if(request('search') || request('kategori')): ?>
                <a href="<?php echo e(route('pengumuman')); ?>" class="px-4 py-3 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors shrink-0">
                    Reset Filter
                </a>
            <?php endif; ?>
        </div>
    </form>

    <!-- Results Counter -->
    <div class="flex items-center justify-between mb-6">
        <p class="text-xs md:text-sm font-medium text-slate-500">
            Menampilkan <span class="font-bold text-slate-900"><?php echo e($pengumuman->count()); ?></span> dari <span class="font-bold text-slate-900"><?php echo e($pengumuman->total()); ?></span> berita
        </p>
    </div>

    <!-- Main News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">
            <div class="relative h-56 bg-slate-100 overflow-hidden">
                <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-rose-900 via-rose-800 to-teal-900 flex items-center justify-center p-6 text-center group-hover:scale-105 transition-transform duration-500">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                            <i data-lucide="file-text" class="w-6 h-6 text-rose-200"></i>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Category Badge -->
                <div class="absolute top-3 left-3">
                    <span class="px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white font-semibold text-[11px] rounded-lg uppercase tracking-wider shadow-md">
                        <?php echo e($item->kategori ? ucfirst($item->kategori) : 'Berita RW'); ?>

                    </span>
                </div>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3 font-medium">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-rose-600"></i>
                            <?php echo e($item->created_at ? $item->created_at->isoFormat('D MMMM Y') : date('d/m/Y')); ?>

                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1">
                            Sekretariat RW 12
                        </span>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug mb-3">
                        <a href="<?php echo e(route('pengumuman.show', $item)); ?>"><?php echo e($item->judul); ?></a>
                    </h2>

                    <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-4">
                        <?php echo e(Str::limit(strip_tags($item->isi), 140)); ?>

                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="<?php echo e(route('pengumuman.show', $item)); ?>" class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-800 group-hover:gap-2.5 transition-all">
                        Baca Selengkapnya
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="file-text" class="w-8 h-8 text-slate-400"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak Berita Ditemukan</h3>
            <p class="text-slate-500 text-sm mt-1">Coba kata kunci atau filter lain untuk menemukan berita yang Anda cari.</p>
        </div>
        <?php endif; ?>
    </div>

    <?php if($pengumuman->hasPages()): ?>
    <div class="mt-12">
        <?php echo e($pengumuman->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\pengumuman.blade.php ENDPATH**/ ?>