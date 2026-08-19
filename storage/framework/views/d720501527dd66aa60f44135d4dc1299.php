<?php $__env->startSection('title', $kegiatan->nama_kegiatan); ?>
<?php $__env->startSection('meta_description', $kegiatan->deskripsi ?: $kegiatan->nama_kegiatan . ' - Kegiatan di Puri Agung Permai RW12.'); ?>
<?php $__env->startSection('og_title', $kegiatan->nama_kegiatan . ' - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', $kegiatan->deskripsi ?: $kegiatan->nama_kegiatan); ?>
<?php if($kegiatan->foto): ?>
<?php $__env->startSection('og_image', asset('storage/' . $kegiatan->foto)); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="<?php echo e(route('kegiatan')); ?>" class="hover:text-rose-600 transition-colors">Kegiatan</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]"><?php echo e(Str::limit($kegiatan->nama_kegiatan, 30)); ?></span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <?php if($kegiatan->foto): ?>
        <img src="<?php echo e(asset('storage/'.$kegiatan->foto)); ?>" alt="<?php echo e($kegiatan->nama_kegiatan); ?>" class="w-full h-64 md:h-80 object-cover">
        <?php endif; ?>
        <div class="p-8 md:p-10">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                    <?php echo e($kegiatan->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : ($kegiatan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700')); ?>">
                    <span class="w-1.5 h-1.5 rounded-full <?php echo e($kegiatan->status === 'akan_datang' ? 'bg-blue-500' : ($kegiatan->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500')); ?>"></span>
                    <?php echo e($kegiatan->status === 'akan_datang' ? 'Akan Datang' : ucfirst($kegiatan->status)); ?>

                </span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6"><?php echo e($kegiatan->nama_kegiatan); ?></h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="calendar" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Tanggal</p>
                        <p class="text-sm font-medium text-slate-900"><?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->isoFormat('D MMMM Y')); ?></p>
                    </div>
                </div>
                <?php if($kegiatan->waktu): ?>
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="clock" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Waktu</p>
                        <p class="text-sm font-medium text-slate-900"><?php echo e($kegiatan->waktu_formatted); ?> WIB</p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($kegiatan->tempat): ?>
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="map-pin" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Tempat</p>
                        <p class="text-sm font-medium text-slate-900"><?php echo e($kegiatan->tempat); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php if($kegiatan->deskripsi): ?>
            <div class="text-slate-700 leading-relaxed">
                <?php echo e($kegiatan->deskripsi); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\kegiatan-show.blade.php ENDPATH**/ ?>