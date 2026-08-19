<?php $__env->startSection('title', $umkm->nama . ' - UMKM'); ?>
<?php $__env->startSection('meta_description', $umkm->deskripsi ? Str::limit(strip_tags($umkm->deskripsi), 160) : 'UMKM ' . $umkm->nama . ' di Puri Agung Permai RW12.'); ?>
<?php $__env->startSection('og_title', $umkm->nama . ' - UMKM RW12'); ?>
<?php $__env->startSection('og_description', $umkm->deskripsi ? Str::limit(strip_tags($umkm->deskripsi), 160) : 'UMKM ' . $umkm->nama); ?>

<?php $__env->startSection('content'); ?>
<!-- Breadcrumbs -->
<div class="bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-rose-600 transition-colors">Beranda</a>
            <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
            <a href="<?php echo e(route('umkm')); ?>" class="hover:text-rose-600 transition-colors">UMKM</a>
            <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
            <span class="text-slate-900 font-medium"><?php echo e($umkm->nama); ?></span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <?php if($umkm->foto): ?>
                <div class="h-64 md:h-80 overflow-hidden">
                    <img src="<?php echo e(asset('storage/'.$umkm->foto)); ?>" alt="<?php echo e($umkm->nama); ?>" class="w-full h-full object-cover">
                </div>
                <?php endif; ?>

                <div class="p-6 md:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <span class="inline-block px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold mb-3">
                                <?php echo e($umkm->kategori); ?>

                            </span>
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900"><?php echo e($umkm->nama); ?></h1>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-6">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="user" class="w-4 h-4 text-rose-500"></i>
                            <?php echo e($umkm->nama_pemilik); ?>

                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-rose-500"></i>
                            RT <?php echo e($umkm->rt); ?>

                        </span>
                        <?php if($umkm->jam_operasional): ?>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-4 h-4 text-rose-500"></i>
                            <?php echo e($umkm->jam_operasional); ?>

                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="prose prose-slate max-w-none">
                        <?php echo nl2br(e($umkm->deskripsi)); ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Informasi Kontak</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik</dt>
                        <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->nama_pemilik); ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Alamat</dt>
                        <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->alamat); ?>, RT <?php echo e($umkm->rt); ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">No. HP / WhatsApp</dt>
                        <dd class="mt-1">
                            <a href="https://wa.me/<?php echo e(ltrim($umkm->no_hp, '0')); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                <?php echo e($umkm->no_hp); ?>

                            </a>
                        </dd>
                    </div>
                    <?php if($umkm->jam_operasional): ?>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Operasional</dt>
                        <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->jam_operasional); ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if($umkm->maps_link): ?>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</dt>
                        <dd class="mt-1">
                            <a href="<?php echo e($umkm->maps_link); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-sm text-rose-600 hover:text-rose-700 font-medium">
                                <i data-lucide="map" class="w-4 h-4"></i>
                                Lihat di Google Maps
                            </a>
                        </dd>
                    </div>
                    <?php endif; ?>
                </dl>
            </div>

            <a href="<?php echo e(route('umkm')); ?>" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Daftar UMKM
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\umkm-show.blade.php ENDPATH**/ ?>