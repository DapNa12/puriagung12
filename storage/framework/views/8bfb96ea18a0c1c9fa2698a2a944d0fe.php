<?php $__env->startSection('title', 'Edit Kegiatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-6">
    <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Kegiatan</h1>
        <p class="text-sm text-slate-500">Perbarui data kegiatan</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="<?php echo e(route('admin.kegiatan.update', $kegiatan)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
            <input type="text" name="nama_kegiatan" value="<?php echo e(old('nama_kegiatan', $kegiatan->nama_kegiatan)); ?>" class="input-field <?php $__errorArgs = ['nama_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = ['nama_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="input-field"><?php echo e(old('deskripsi', $kegiatan->deskripsi)); ?></textarea>
        </div>

        <div class="mb-4">
            <p class="block text-sm font-semibold text-slate-700 mb-1">Waktu Pelaksanaan</p>
            <p class="text-xs text-slate-400 mb-3">Kapan kegiatan ini akan dilaksanakan.</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="<?php echo e(old('tanggal', $kegiatan->tanggal)); ?>" class="input-field <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jam Mulai</label>
                    <input type="time" name="waktu" value="<?php echo e(old('waktu', $kegiatan->waktu)); ?>" class="input-field">
                    <p class="text-xs text-slate-400 mt-1">Kosongi jika jam belum ditentukan.</p>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tempat</label>
            <input type="text" name="tempat" value="<?php echo e(old('tempat', $kegiatan->tempat)); ?>" class="input-field">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" class="input-field <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value="akan_datang" <?php if(old('status', $kegiatan->status)=='akan_datang'): echo 'selected'; endif; ?>>Akan Datang</option>
                <option value="selesai" <?php if(old('status', $kegiatan->status)=='selesai'): echo 'selected'; endif; ?>>Selesai</option>
                <option value="dibatalkan" <?php if(old('status', $kegiatan->status)=='dibatalkan'): echo 'selected'; endif; ?>>Dibatalkan</option>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <?php if($kegiatan->foto): ?>
        <div class="mb-4">
            <p class="text-sm font-medium text-slate-700 mb-2">Foto Saat Ini</p>
            <img src="<?php echo e(asset('storage/'.$kegiatan->foto)); ?>" alt="Foto" class="w-48 h-32 object-cover rounded-xl border border-slate-200">
        </div>
        <?php endif; ?>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto</label>
            <input type="file" name="foto" accept="image/*" class="input-field <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB.</p>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\kegiatan\edit.blade.php ENDPATH**/ ?>