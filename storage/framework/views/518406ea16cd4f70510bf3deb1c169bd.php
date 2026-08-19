<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center py-12">
    <i data-lucide="shield-check" class="w-16 h-16 text-rose-500 mx-auto mb-4"></i>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
    <p class="text-gray-500 mb-6">Anda berhasil login ke sistem Puri Agung Permai RW12.</p>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-rose-600 text-white font-medium rounded-xl hover:bg-rose-700 transition-all">
        Buka Admin Dashboard
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\dashboard.blade.php ENDPATH**/ ?>