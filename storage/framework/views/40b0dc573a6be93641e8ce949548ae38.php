<?php $__env->startSection('title', 'Kegiatan'); ?>
<?php $__env->startSection('meta_description', 'Agenda dan kegiatan di lingkungan Puri Agung Permai RW12. Informasi acara dan agenda warga.'); ?>
<?php $__env->startSection('og_title', 'Kegiatan - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Agenda dan kegiatan di lingkungan Puri Agung Permai RW12.'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Kegiatan RW</h1>
        <p class="text-slate-500 mt-2">Agenda dan acara di lingkungan Puri Agung Permai RW12</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            <?php if($item->foto): ?>
            <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama_kegiatan); ?>" class="w-full h-48 object-cover">
            <?php else: ?>
            <div class="w-full h-48 bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                <i data-lucide="calendar" class="w-12 h-12 text-rose-300"></i>
            </div>
            <?php endif; ?>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                        <?php echo e($item->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : ($item->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700')); ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?php echo e($item->status === 'akan_datang' ? 'bg-blue-500' : ($item->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500')); ?>"></span>
                        <?php echo e($item->status === 'akan_datang' ? 'Akan Datang' : ucfirst($item->status)); ?>

                    </span>
                </div>
                <h3 class="font-bold text-slate-900 mb-2"><?php echo e($item->nama_kegiatan); ?></h3>
                <div class="space-y-1.5 text-sm text-slate-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 flex-shrink-0"></i>
                        <span><?php echo e(\Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')); ?></span>
                    </div>
                    <?php if($item->waktu): ?>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span><?php echo e($item->waktu_formatted); ?> WIB</span>
                    </div>
                    <?php endif; ?>
                    <?php if($item->tempat): ?>
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span><?php echo e($item->tempat); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full text-center py-16">
            <i data-lucide="calendar" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
            <p class="text-slate-500">Belum ada kegiatan.</p>
        </div>
        <?php endif; ?>
    </div>

    <?php if($kegiatan->hasPages()): ?>
    <div class="mt-8">
        <?php echo e($kegiatan->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\kegiatan.blade.php ENDPATH**/ ?>