<?php $__env->startSection('title', 'Galeri'); ?>
<?php $__env->startSection('meta_description', 'Galeri foto kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12.'); ?>
<?php $__env->startSection('og_title', 'Galeri - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Galeri foto kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12.'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Galeri Momen</h1>
        <p class="text-slate-500 mt-2">Dokumentasi kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12</p>
    </div>

    <?php if($albums->count() > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('galeri.show', $item->id)); ?>" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            <div class="relative h-52 overflow-hidden">
                <?php if($item->cover): ?>
                <img src="<?php echo e(asset('storage/'.$item->cover)); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <i data-lucide="image" class="w-12 h-12 text-rose-300"></i>
                </div>
                <?php endif; ?>
                <span class="absolute top-3 right-3 bg-black/60 text-white text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm">
                    <?php echo e($item->fotos_count); ?> foto
                </span>
            </div>
            <div class="p-5">
                <h2 class="font-bold text-slate-900 mb-1 group-hover:text-rose-600 transition-colors"><?php echo e($item->judul); ?></h2>
                <p class="text-xs text-slate-500"><?php echo e($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') : \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y')); ?></p>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($albums->hasPages()): ?>
    <div class="mt-8">
        <?php echo e($albums->onEachSide(1)->links()); ?>

    </div>
    <?php endif; ?>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada momen</p>
        <p class="text-slate-400 text-sm mt-1">Momen kegiatan akan tampil di sini.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\galeri.blade.php ENDPATH**/ ?>