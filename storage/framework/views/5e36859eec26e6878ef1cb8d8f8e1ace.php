<?php $__env->startSection('title', 'Detail Pengumuman'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Pengumuman</h1>
            <p class="text-sm text-slate-500">Isi pengumuman untuk warga</p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="<?php echo e(route('admin.pengumuman.edit', $pengumuman)); ?>" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 max-w-xl">
        <?php if($pengumuman->foto): ?>
        <div class="mb-6 -m-8 -mt-0">
            <img src="<?php echo e(asset('storage/'.$pengumuman->foto)); ?>" class="w-full max-h-64 object-cover rounded-t-2xl border-b border-slate-100">
        </div>
        <?php endif; ?>
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-4">
        <i data-lucide="user" class="w-4 h-4"></i>
        <span><?php echo e($pengumuman->user->name); ?></span>
        <span class="text-gray-300">•</span>
        <span><?php echo e($pengumuman->created_at->isoFormat('D MMMM Y')); ?></span>
    </div>
    <h2 class="text-xl font-bold text-slate-900 mb-4"><?php echo e($pengumuman->judul); ?></h2>
    <div class="text-slate-700 leading-relaxed text-sm"><?php echo e($pengumuman->isi); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\pengumuman\show.blade.php ENDPATH**/ ?>