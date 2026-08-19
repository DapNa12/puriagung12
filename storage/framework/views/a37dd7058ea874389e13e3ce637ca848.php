<?php $__env->startSection('title', 'Edit Pengumuman'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-6">
    <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengumuman</h1>
        <p class="text-sm text-slate-500">Perbarui pengumuman</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="<?php echo e(route('admin.pengumuman.update', $pengumuman)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Berita / Pengumuman <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="<?php echo e(old('judul', $pengumuman->judul)); ?>" class="input-field <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
            <select name="kategori" class="input-field <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value="kegiatan" <?php if(old('kategori', $pengumuman->kategori)=='kegiatan'): echo 'selected'; endif; ?>>Kegiatan</option>
                <option value="pemberitahuan" <?php if(old('kategori', $pengumuman->kategori)=='pemberitahuan'): echo 'selected'; endif; ?>>Pemberitahuan</option>
            </select>
            <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Isi <span class="text-red-500">*</span></label>
            <textarea name="isi" rows="6" class="input-field <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('isi', $pengumuman->isi)); ?></textarea>
            <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            <?php if($pengumuman->foto): ?>
            <div class="mb-2 relative inline-block" id="foto-preview-wrapper">
                <img src="<?php echo e(asset('storage/'.$pengumuman->foto)); ?>" id="foto-preview-img" class="w-32 h-24 object-cover rounded-xl border border-slate-200 transition-all duration-200">
                <button type="button" id="btn-remove-foto" onclick="toggleRemoveFoto()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm transition-all duration-200" title="Hapus foto">
                    <i data-lucide="x" class="w-3 h-3 pointer-events-none"></i>
                </button>
                <input type="hidden" name="remove_foto" id="remove-foto-input" value="0">
                <p class="text-xs text-slate-400 mt-1" id="foto-status-text">Foto saat ini</p>
            </div>
            <script>
            function toggleRemoveFoto() {
                var img = document.getElementById('foto-preview-img');
                var btn = document.getElementById('btn-remove-foto');
                var input = document.getElementById('remove-foto-input');
                var text = document.getElementById('foto-status-text');
                if (input.value === '1') {
                    input.value = '0';
                    img.classList.remove('opacity-0', 'scale-95');
                    btn.classList.remove('bg-gray-400', 'hover:bg-gray-500');
                    btn.classList.add('bg-red-500', 'hover:bg-red-600');
                    text.textContent = 'Foto saat ini';
                    text.className = 'text-xs text-slate-400 mt-1';
                } else {
                    input.value = '1';
                    img.classList.add('opacity-0', 'scale-95');
                    btn.classList.remove('bg-red-500', 'hover:bg-red-600');
                    btn.classList.add('bg-gray-400', 'hover:bg-gray-500');
                    text.textContent = 'Foto akan dihapus';
                    text.className = 'text-xs text-red-500 font-medium mt-1';
                }
            }
            document.getElementById('foto-upload-input')?.addEventListener('change', function() {
                if (this.files.length > 0 && document.getElementById('remove-foto-input').value === '1') {
                    toggleRemoveFoto();
                }
            });
            </script>
            <?php endif; ?>
            <input type="file" name="foto" id="foto-upload-input" accept="image/*" class="input-field <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB. Upload file untuk mengganti foto.</p>
            <?php $__errorArgs = ['foto'];
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
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Mulai</label>
                <input type="date" name="tgl_mulai" value="<?php echo e(old('tgl_mulai', $pengumuman->tgl_mulai)); ?>" class="input-field">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Selesai</label>
                <input type="date" name="tgl_selesai" value="<?php echo e(old('tgl_selesai', $pengumuman->tgl_selesai)); ?>" class="input-field">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" class="input-field <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value="aktif" <?php if(old('status', $pengumuman->status)=='aktif'): echo 'selected'; endif; ?>>Aktif</option>
                <option value="nonaktif" <?php if(old('status', $pengumuman->status)=='nonaktif'): echo 'selected'; endif; ?>>Nonaktif</option>
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

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\pengumuman\edit.blade.php ENDPATH**/ ?>