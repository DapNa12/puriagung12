<?php $__env->startSection('title', $album->judul . ' - Galeri'); ?>
<?php $__env->startSection('meta_description', $album->deskripsi ?: 'Galeri foto: ' . $album->judul . ' - Puri Agung Permai RW12.'); ?>
<?php $__env->startSection('og_title', $album->judul . ' - Galeri Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', $album->deskripsi ?: 'Galeri foto: ' . $album->judul); ?>
<?php if($album->sampul): ?>
<?php $__env->startSection('og_image', asset('storage/' . $album->sampul)); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="<?php echo e(route('galeri')); ?>" class="hover:text-rose-600 transition-colors">Galeri</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]"><?php echo e(Str::limit($album->judul, 30)); ?></span>
    </nav>

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900"><?php echo e($album->judul); ?></h1>
        <p class="text-slate-500 mt-2">
            <?php if($album->tanggal): ?><?php echo e(\Carbon\Carbon::parse($album->tanggal)->isoFormat('D MMMM Y')); ?> · <?php endif; ?>
            <?php echo e($album->fotos->count()); ?> foto
        </p>
        <?php if($album->deskripsi): ?>
        <p class="text-slate-600 mt-4 max-w-3xl leading-relaxed"><?php echo e($album->deskripsi); ?></p>
        <?php endif; ?>
    </div>

    <?php if($album->fotos->count() > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <?php $__currentLoopData = $album->fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="galery-item group relative rounded-2xl overflow-hidden bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all cursor-zoom-in"
                data-index="<?php echo e($index); ?>" data-src="<?php echo e(asset('storage/'.$foto->foto)); ?>" data-total="<?php echo e($album->fotos->count()); ?>">
            <img src="<?php echo e(asset('storage/'.$foto->foto)); ?>" alt="Foto <?php echo e($index + 1); ?> di <?php echo e($album->judul); ?>" loading="lazy" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
        </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div id="lightbox" class="hidden fixed inset-0 z-[100] bg-black/90 backdrop-blur-sm items-center justify-center">
        <button type="button" id="lightbox-close" class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all z-10" aria-label="Tutup">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        <button type="button" id="lightbox-prev" class="absolute left-2 md:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all" aria-label="Sebelumnya">
            <i data-lucide="chevron-left" class="w-6 h-6"></i>
        </button>
        <button type="button" id="lightbox-next" class="absolute right-2 md:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all" aria-label="Berikutnya">
            <i data-lucide="chevron-right" class="w-6 h-6"></i>
        </button>
        <figure class="max-w-5xl w-full px-4 md:px-16">
            <img id="lightbox-img" src="" alt="Foto galeri" class="w-full max-h-[78vh] object-contain mx-auto rounded-lg">
            <figcaption id="lightbox-caption" class="text-center text-sm text-slate-300 mt-4"></figcaption>
        </figure>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada foto di album ini</p>
        <p class="text-slate-400 text-sm mt-1">Momen akan tampil di sini setelah diunggah.</p>
    </div>
    <?php endif; ?>
</div>

<?php if($album->fotos->count() > 0): ?>
<script>
(function () {
    var items = Array.prototype.slice.call(document.querySelectorAll('.galery-item'));
    var lightbox = document.getElementById('lightbox');
    var img = document.getElementById('lightbox-img');
    var caption = document.getElementById('lightbox-caption');
    var current = 0;

    function show(index) {
        current = index;
        var el = items[index];
        img.src = el.dataset.src;
        caption.textContent = (index + 1) + ' / ' + el.dataset.total;
    }

    function open(index) {
        show(index);
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }

    items.forEach(function (el) {
        el.addEventListener('click', function () {
            open(parseInt(el.dataset.index, 10));
        });
    });

    document.getElementById('lightbox-close').addEventListener('click', close);
    document.getElementById('lightbox-prev').addEventListener('click', function () {
        show((current - 1 + items.length) % items.length);
    });
    document.getElementById('lightbox-next').addEventListener('click', function () {
        show((current + 1) % items.length);
    });

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) close();
    });

    document.addEventListener('keydown', function (e) {
        if (lightbox.classList.contains('hidden')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') show((current - 1 + items.length) % items.length);
        if (e.key === 'ArrowRight') show((current + 1) % items.length);
    });
})();
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\galeri-show.blade.php ENDPATH**/ ?>