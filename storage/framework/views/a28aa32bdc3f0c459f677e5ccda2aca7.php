<?php $__env->startSection('title', $pengumuman->judul); ?>
<?php $__env->startSection('meta_description', strip_tags(Str::limit($pengumuman->isi, 160))); ?>
<?php $__env->startSection('og_title', $pengumuman->judul . ' - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', strip_tags(Str::limit($pengumuman->isi, 160))); ?>
<?php if($pengumuman->foto): ?>
<?php $__env->startSection('og_image', asset('storage/' . $pengumuman->foto)); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="<?php echo e(route('pengumuman')); ?>" class="hover:text-rose-600 transition-colors">Berita</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]"><?php echo e(Str::limit($pengumuman->judul, 30)); ?></span>
    </nav>

    <article class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 md:p-10">
        <div class="flex items-center gap-3 text-sm text-slate-400 mb-4">
            <span><?php echo e($pengumuman->created_at->isoFormat('D MMMM Y')); ?></span>
            <span>&middot;</span>
            <span><?php echo e($pengumuman->user->name ?? 'Admin'); ?></span>
        </div>
        <?php if($pengumuman->foto): ?>
        <div class="mb-6 overflow-hidden rounded-xl">
            <img src="<?php echo e(asset('storage/'.$pengumuman->foto)); ?>" alt="<?php echo e($pengumuman->judul); ?>" class="w-full h-auto object-cover">
        </div>
        <?php endif; ?>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 leading-tight"><?php echo e($pengumuman->judul); ?></h1>
        <div class="prose prose-gray max-w-none text-slate-700 leading-relaxed">
            <?php echo e($pengumuman->isi); ?>

        </div>
    </article>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\pengumuman-show.blade.php ENDPATH**/ ?>