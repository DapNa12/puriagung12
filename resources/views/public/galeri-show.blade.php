@extends('layouts.public')

@section('title', $album->judul . ' - Galeri')
@section('meta_description', $album->deskripsi ?: 'Galeri foto: ' . $album->judul . ' - Puri Agung Permai RW12.')
@section('meta_keywords', strtolower($album->judul).', puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, galeri foto rw 12')
@section('og_title', $album->judul . ' - Galeri Puri Agung Permai RW12')
@section('og_description', $album->deskripsi ?: 'Galeri foto: ' . $album->judul)
@if($album->sampul)
@section('og_image', asset('storage/' . $album->sampul))
@endif

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('galeri') }}" class="hover:text-rose-600 transition-colors">Galeri</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ Str::limit($album->judul, 30) }}</span>
    </nav>

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">{{ $album->judul }}</h1>
        <p class="text-slate-500 mt-2">
            @if($album->tanggal){{ \Carbon\Carbon::parse($album->tanggal)->isoFormat('D MMMM Y') }} · @endif
            {{ $album->fotos->count() }} foto
        </p>
        @if($album->deskripsi)
        <p class="text-slate-600 mt-4 max-w-3xl leading-relaxed">{{ $album->deskripsi }}</p>
        @endif
    </div>

    @if($album->fotos->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($album->fotos as $index => $foto)
        <button type="button" class="galery-item group relative rounded-2xl overflow-hidden bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all cursor-zoom-in"
                data-index="{{ $index }}" data-src="{{ asset('storage/'.$foto->foto) }}" data-total="{{ $album->fotos->count() }}">
            <img src="{{ asset('storage/'.$foto->foto) }}" alt="Foto {{ $index + 1 }} di {{ $album->judul }}" loading="lazy" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
        </button>
        @endforeach
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
    @else
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada foto di album ini</p>
        <p class="text-slate-400 text-sm mt-1">Momen akan tampil di sini setelah diunggah.</p>
    </div>
    @endif
</div>

@if($album->fotos->count() > 0)
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
@endif
@endsection
