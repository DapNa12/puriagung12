<?php $__env->startSection('title', $album->judul); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-6">
    <a href="<?php echo e(route('admin.galeri.index')); ?>" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div class="flex-1 min-w-0">
        <h1 class="text-2xl font-bold text-slate-900 truncate"><?php echo e($album->judul); ?></h1>
        <p class="text-sm text-slate-500">
            <?php if($album->tanggal): ?><?php echo e(\Carbon\Carbon::parse($album->tanggal)->isoFormat('D MMMM Y')); ?> · <?php endif; ?>
            <?php echo e($album->fotos->count()); ?> foto
        </p>
    </div>
    <a href="<?php echo e(route('galeri.show', $album->id)); ?>" target="_blank" class="btn-secondary text-xs whitespace-nowrap">Lihat Publik</a>
    <a href="<?php echo e(route('admin.galeri.edit', $album->id)); ?>" class="btn-soft-yellow whitespace-nowrap">Edit Album</a>
</div>

<?php if($album->deskripsi): ?>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <p class="text-sm text-slate-600 leading-relaxed"><?php echo e($album->deskripsi); ?></p>
</div>
<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <h2 class="text-base font-bold text-slate-900 mb-1">Tambah Foto</h2>
    <p class="text-xs text-slate-500 mb-4">Tambahkan foto baru ke album ini.</p>
    <form action="<?php echo e(route('admin.galeri.update', $album->id)); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <input type="hidden" name="judul" value="<?php echo e($album->judul); ?>">
        <input type="file" name="fotos[]" accept="image/*" multiple class="input-field flex-1 <?php $__errorArgs = ['fotos.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <button type="submit" class="btn-primary whitespace-nowrap">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Upload Foto
        </button>
    </form>
    <?php $__errorArgs = ['fotos.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<?php if($album->fotos->count() > 0): ?>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php $__currentLoopData = $album->fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden card-hover group relative">
        <a href="<?php echo e(asset('storage/'.$foto->foto)); ?>" target="_blank" class="block h-40 overflow-hidden">
            <img src="<?php echo e(asset('storage/'.$foto->foto)); ?>" alt="Foto #<?php echo e($foto->id); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </a>
        <div class="p-3 flex items-center justify-between gap-2">
            <span class="text-xs text-slate-500 truncate">Foto #<?php echo e($foto->id); ?></span>
            <form action="<?php echo e(route('admin.galeri.foto.destroy', [$album->id, $foto->id])); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-soft-red p-1.5">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada foto di album ini</p>
    <p class="text-slate-400 text-sm mt-1">Unggah foto melalui form di atas.</p>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\galeri\show.blade.php ENDPATH**/ ?>