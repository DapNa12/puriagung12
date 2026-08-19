<?php $__env->startSection('title', 'Edit Pengurus'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-6">
    <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengurus</h1>
        <p class="text-sm text-slate-500">Perbarui data pengurus</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-lg">
    <form action="<?php echo e(route('admin.pengurus.update', $pengurus->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="<?php echo e(old('nama', $pengurus->nama)); ?>" placeholder="Nama lengkap pengurus" class="input-field <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">RT</label>
            <input type="text" name="rt" list="rt-list" value="<?php echo e(old('rt', $pengurus->rt)); ?>" placeholder="Contoh: 001" maxlength="3" class="input-field <?php $__errorArgs = ['rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <datalist id="rt-list">
                <?php $__currentLoopData = $daftarRt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($rt); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </datalist>
            <?php $__errorArgs = ['rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <p class="text-xs text-slate-400 mt-1">Nomor RT tempat pengurus bertugas. Kosongi untuk pengurus RW.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
            <select name="jabatan" class="input-field <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $opsiJabatan = ['Ketua RT', 'Sekretaris RT', 'Bendahara RT', 'Ketua RW', 'Wakil Ketua', 'Sekretaris', 'Bendahara']; ?>
                <?php if($pengurus->jabatan && !in_array($pengurus->jabatan, $opsiJabatan)): ?>
                <option value="<?php echo e($pengurus->jabatan); ?>" <?php if(old('jabatan', $pengurus->jabatan)==$pengurus->jabatan): echo 'selected'; endif; ?>><?php echo e($pengurus->jabatan); ?> (kustom)</option>
                <?php endif; ?>
                <?php $__currentLoopData = $opsiJabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opsi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($opsi); ?>" <?php if(old('jabatan', $pengurus->jabatan)==$opsi): echo 'selected'; endif; ?>><?php echo e($opsi); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Mulai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_mulai" value="<?php echo e(old('periode_mulai', $pengurus->periode_mulai)); ?>" class="input-field <?php $__errorArgs = ['periode_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['periode_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Selesai</label>
                <input type="date" name="periode_selesai" value="<?php echo e(old('periode_selesai', $pengurus->periode_selesai)); ?>" class="input-field">
                <p class="text-xs text-slate-400 mt-1">Kosongi jika masih menjabat</p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            <?php if($pengurus->foto): ?>
            <div class="mb-2">
                <img src="<?php echo e(asset('storage/'.$pengurus->foto)); ?>" class="w-20 h-20 object-cover rounded-xl border border-slate-200">
                <p class="text-xs text-slate-400 mt-1">Foto saat ini</p>
            </div>
            <?php endif; ?>
            <input type="file" name="foto" accept="image/*" class="input-field <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB. Kosongi jika tidak ingin mengubah foto.</p>
            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\pengurus\edit.blade.php ENDPATH**/ ?>