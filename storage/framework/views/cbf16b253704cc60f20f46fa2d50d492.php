<?php $__env->startSection('title', 'Detail Pengurus'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Pengurus</h1>
            <p class="text-sm text-slate-500"><?php echo e($pengurus->jabatan); ?></p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="<?php echo e(route('admin.pengurus.edit', $pengurus->id)); ?>" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:col-span-1">
        <?php if($pengurus->foto): ?>
        <img src="<?php echo e(asset('storage/'.$pengurus->foto)); ?>" class="w-full max-w-48 mx-auto aspect-square object-cover rounded-2xl border border-slate-200">
        <?php else: ?>
        <div class="w-48 h-48 mx-auto bg-rose-100 rounded-2xl flex items-center justify-center border border-slate-200">
            <span class="text-5xl font-bold text-rose-600"><?php echo e(substr($pengurus->nama ?? 'P', 0, 1)); ?></span>
        </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <h2 class="text-xl font-bold text-slate-900"><?php echo e($pengurus->nama ?? '-'); ?></h2>
            <p class="text-rose-600 font-medium"><?php echo e($pengurus->jabatan); ?></p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:col-span-2">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Informasi Kepengurusan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Periode Mulai</p>
                <p class="text-sm font-medium text-slate-900 mt-1"><?php echo e(\Carbon\Carbon::parse($pengurus->periode_mulai)->isoFormat('D MMMM Y')); ?></p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Periode Selesai</p>
                <p class="text-sm font-medium text-slate-900 mt-1"><?php echo e($pengurus->periode_selesai ? \Carbon\Carbon::parse($pengurus->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang (masih menjabat)'); ?></p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Nama</p>
                <p class="text-sm font-medium text-slate-900 mt-1"><?php echo e($pengurus->nama ?? '-'); ?></p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">RT</p>
                <p class="text-sm font-medium text-slate-900 mt-1"><?php echo e($pengurus->rt ? 'RT '.$pengurus->rt : 'RW (tanpa RT)'); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\pengurus\show.blade.php ENDPATH**/ ?>