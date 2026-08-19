<?php $__env->startSection('title', 'Detail Kegiatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Kegiatan</h1>
            <p class="text-sm text-slate-500">Informasi lengkap kegiatan RW</p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="<?php echo e(route('admin.kegiatan.edit', $kegiatan)); ?>" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-xl">
    <?php if($kegiatan->foto): ?>
    <img src="<?php echo e(asset('storage/'.$kegiatan->foto)); ?>" alt="<?php echo e($kegiatan->nama_kegiatan); ?>" class="w-full h-56 object-cover">
    <?php endif; ?>
    <div class="p-6">
        <span class="badge
            <?php echo e($kegiatan->status === 'akan_datang' ? 'bg-rose-50 text-rose-700' : ($kegiatan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700')); ?>">
            <span class="badge-dot <?php echo e($kegiatan->status === 'akan_datang' ? 'bg-rose-500' : ($kegiatan->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500')); ?>"></span>
            <?php echo e(str_replace('_', ' ', ucfirst($kegiatan->status))); ?>

        </span>
        <h2 class="text-xl font-bold text-slate-900 mt-3"><?php echo e($kegiatan->nama_kegiatan); ?></h2>
        <div class="text-slate-600 mt-4 space-y-2 text-sm">
            <div class="flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Tanggal:</span> <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->isoFormat('D MMMM Y')); ?></span>
            </div>
            <?php if($kegiatan->waktu): ?>
            <div class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Waktu:</span> <?php echo e($kegiatan->waktu_formatted); ?> WIB</span>
            </div>
            <?php endif; ?>
            <?php if($kegiatan->tempat): ?>
            <div class="flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Tempat:</span> <?php echo e($kegiatan->tempat); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php if($kegiatan->deskripsi): ?>
        <div class="mt-5 pt-4 border-t border-slate-100 text-slate-700 text-sm leading-relaxed"><?php echo e($kegiatan->deskripsi); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\kegiatan\show.blade.php ENDPATH**/ ?>