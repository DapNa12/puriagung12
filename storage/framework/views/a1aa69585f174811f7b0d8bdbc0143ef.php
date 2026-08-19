<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Galeri</h1>
        <p class="text-sm text-slate-500 mt-0.5">Simpan momen-momen kegiatan dalam album foto</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="<?php echo e(route('galeri')); ?>" target="_blank" class="btn-secondary text-xs">Lihat Halaman Publik</a>
        <a href="<?php echo e(route('admin.galeri.create')); ?>" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Album
        </a>
    </div>
</div>

<form method="GET" class="mb-6">
    <div class="flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari judul album..." class="input-field pl-10">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

<?php if($albums->count() > 0): ?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden card-hover">
        <a href="<?php echo e(route('admin.galeri.show', $album->id)); ?>" class="block relative h-44 overflow-hidden group">
            <?php if($album->cover): ?>
            <img src="<?php echo e(asset('storage/'.$album->cover)); ?>" alt="<?php echo e($album->judul); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                <i data-lucide="image" class="w-12 h-12 text-rose-300"></i>
            </div>
            <?php endif; ?>
            <span class="absolute top-3 right-3 bg-black/60 text-white text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm">
                <?php echo e($album->fotos_count); ?> foto
            </span>
        </a>
        <div class="p-5">
            <h3 class="font-bold text-slate-900 mb-1"><?php echo e($album->judul); ?></h3>
            <p class="text-xs text-slate-500 mb-4"><?php echo e($album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->isoFormat('D MMMM Y') : \Carbon\Carbon::parse($album->created_at)->isoFormat('D MMMM Y')); ?></p>
            <div class="flex items-center gap-1.5 pt-3 border-t border-slate-100">
                <a href="<?php echo e(route('admin.galeri.show', $album->id)); ?>" class="btn-soft-blue">Detail</a>
                <a href="<?php echo e(route('admin.galeri.edit', $album->id)); ?>" class="btn-soft-yellow">Edit</a>
                <form action="<?php echo e(route('admin.galeri.destroy', $album->id)); ?>" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus album beserta seluruh fotonya?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-soft-red">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($albums->hasPages()): ?>
<div class="mt-6 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan <?php echo e($albums->firstItem()); ?> - <?php echo e($albums->lastItem()); ?> dari <?php echo e($albums->total()); ?> album</p>
    <?php echo e($albums->onEachSide(1)->links()); ?>

</div>
<?php endif; ?>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada album galeri</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan membuat album momen pertama Anda.</p>
    <a href="<?php echo e(route('admin.galeri.create')); ?>" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah Album
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\galeri\index.blade.php ENDPATH**/ ?>