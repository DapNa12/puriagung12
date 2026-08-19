@extends('layouts.public')

@section('title', 'Beranda')
@section('meta_description', 'Portal resmi Puri Agung Permai RW12, Kelurahan Gelam Jaya, Kecamatan Pasar Kemis, Kabupaten Tangerang. Informasi berita, pengumuman, kegiatan, dan layanan warga.')
@section('og_title', 'Puri Agung Permai RW12 - Beranda')
@section('og_description', 'Portal resmi Puri Agung Permai RW12. Informasi berita, pengumuman, kegiatan, dan layanan warga.')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-rose-900 via-rose-800 to-teal-900 text-white overflow-hidden">
    <div class="absolute inset-0">
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-all duration-1000" style="background-image: url('{{ asset('images/hero/slide1.jpg') }}')"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-all duration-1000" style="background-image: url('{{ asset('images/hero/slide2.jpg') }}')"></div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-black/30 to-black/50"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-24 md:py-32 flex flex-col items-center text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-800/50 border border-rose-700/50 text-rose-200 text-sm font-medium mb-6 backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
            Portal Resmi Lingkungan
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight leading-tight">
            Selamat Datang di <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-200 to-teal-100">Puri Agung Permai RW12</span>
        </h1>
        <p class="text-lg md:text-xl text-rose-100/90 max-w-2xl font-light mb-6 leading-relaxed">
            Kelurahan Gelam Jaya, Kecamatan Pasar Kemis, <br class="hidden sm:block"/> Kabupaten Tangerang, Banten
        </p>
        <p id="slide-tagline" class="text-base md:text-lg text-rose-200/80 font-light max-w-xl transition-all duration-700 min-h-[1.5rem]">
            Kebersamaan warga dalam membangun lingkungan yang harmonis
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center w-full sm:w-auto">
            <a href="{{ route('pengumuman') }}" class="group relative inline-flex items-center justify-center gap-2 bg-white text-rose-900 px-8 py-3.5 rounded-xl font-semibold hover:bg-rose-50 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transform hover:-translate-y-1 overflow-hidden">
                <span class="relative z-10">Lihat Pengumuman</span>
                <i data-lucide="arrow-right" class="w-5 h-5 relative z-10 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="{{ route('kegiatan') }}" class="inline-flex items-center justify-center gap-2 bg-rose-700/50 hover:bg-rose-600/60 text-white border border-rose-500/30 backdrop-blur-md px-8 py-3.5 rounded-xl font-semibold transition-all duration-300 hover:border-rose-400/50 transform hover:-translate-y-1">
                <i data-lucide="calendar" class="w-5 h-5"></i>
                Agenda Kegiatan
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var slides = document.querySelectorAll('.hero-slide');
    var taglineEl = document.getElementById('slide-tagline');
    var captions = [
        'Kebersamaan warga dalam membangun lingkungan yang harmonis',
        'Informasi terbaru seputar kegiatan dan pengumuman RW'
    ];
    if (slides.length > 0) {
        var current = 0;
        slides[current].classList.remove('opacity-0');
        slides[current].classList.add('opacity-100');
        if (taglineEl) taglineEl.textContent = captions[current];
        setInterval(function() {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            current = (current + 1) % slides.length;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
            if (taglineEl) {
                taglineEl.style.opacity = '0';
                taglineEl.style.transform = 'translateY(10px)';
                setTimeout(function() {
                    taglineEl.textContent = captions[current];
                    taglineEl.style.opacity = '1';
                    taglineEl.style.transform = 'translateY(0)';
                }, 200);
            }
        }, 5000);
    }
});
</script>

<!-- Stats Section (Pulled up) -->
<div class="max-w-7xl mx-auto px-4 relative z-20 -mt-12 md:-mt-16 mb-20" data-aos="fade-up">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 p-6 flex flex-col items-center border border-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-200/50">
            <div class="w-14 h-14 bg-gradient-to-br from-rose-100 to-rose-50 rounded-2xl flex items-center justify-center mb-4 text-rose-600 shadow-inner">
                <i data-lucide="users" class="w-7 h-7"></i>
            </div>
            <div class="text-4xl font-extrabold text-slate-900 mb-1"><span data-count="{{ $totalWarga }}">0</span></div>
            <div class="text-slate-500 font-medium text-sm uppercase tracking-wider">Total Warga</div>
        </div>
        
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 p-6 flex flex-col items-center border border-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-200/50" data-aos="fade-up" data-aos-delay="100">
            <div class="w-14 h-14 bg-gradient-to-br from-rose-100 to-rose-50 rounded-2xl flex items-center justify-center mb-4 text-rose-600 shadow-inner">
                <i data-lucide="megaphone" class="w-7 h-7"></i>
            </div>
            <div class="text-4xl font-extrabold text-slate-900 mb-1"><span data-count="{{ $pengumuman->count() }}">0</span></div>
            <div class="text-slate-500 font-medium text-sm uppercase tracking-wider">Pengumuman Aktif</div>
        </div>
        
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 p-6 flex flex-col items-center border border-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-200/50" data-aos="fade-up" data-aos-delay="200">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-50 rounded-2xl flex items-center justify-center mb-4 text-amber-600 shadow-inner">
                <i data-lucide="calendar" class="w-7 h-7"></i>
            </div>
            <div class="text-4xl font-extrabold text-slate-900 mb-1"><span data-count="{{ $kegiatan->count() }}">0</span></div>
            <div class="text-slate-500 font-medium text-sm uppercase tracking-wider">Kegiatan Mendatang</div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-20" data-aos="fade-up">
    @if($pengumuman->count())
    <div class="mb-20" data-aos="fade-up">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-rose-600 font-semibold tracking-wider text-sm uppercase mb-1 block">Informasi</span>
                <h2 class="text-3xl font-bold text-slate-900">Pengumuman Terbaru</h2>
            </div>
            <a href="{{ route('pengumuman') }}" class="hidden sm:inline-flex items-center gap-1 text-rose-600 font-medium hover:text-rose-700 hover:underline">
                Lihat Semua
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pengumuman->take(3) as $item)
            <a href="{{ route('pengumuman.show', $item) }}" class="group bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:border-rose-100 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                <div class="h-48 bg-slate-100 relative overflow-hidden shrink-0">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <i data-lucide="file-text" class="w-12 h-12 text-rose-300"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-4">
                        <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md">{{ $item->created_at->isoFormat('D MMM Y') }}</span>
                        <span>&bull;</span>
                        <span>Puri Agung</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-rose-700 transition-colors line-clamp-2">{{ $item->judul }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">{{ Str::limit($item->isi, 120) }}</p>
                    <div class="flex items-center text-rose-600 font-medium text-sm mt-auto group-hover:translate-x-1 transition-transform">
                        Baca detail <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($kegiatan->count())
    <div data-aos="fade-up">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-rose-600 font-semibold tracking-wider text-sm uppercase mb-1 block">Agenda</span>
                <h2 class="text-3xl font-bold text-slate-900">Kegiatan Mendatang</h2>
            </div>
            <a href="{{ route('kegiatan') }}" class="hidden sm:inline-flex items-center gap-1 text-rose-600 font-medium hover:text-rose-700 hover:underline">
                Lihat Semua
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($kegiatan->take(4) as $item)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col sm:flex-row hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="sm:w-48 h-48 sm:h-auto shrink-0 bg-slate-100 relative overflow-hidden">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_kegiatan }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-500">
                        <i data-lucide="calendar" class="w-12 h-12 text-rose-300"></i>
                    </div>
                    @endif
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm text-center">
                        <div class="text-xs font-bold text-slate-500 uppercase">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('MMM') }}</div>
                        <div class="text-xl font-extrabold text-slate-900 leading-none">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</div>
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-center flex-1">
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-rose-700 transition-colors">{{ $item->nama_kegiatan }}</h3>
                    <div class="space-y-2 text-sm text-slate-600">
                        @if($item->waktu)
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                            <span>{{ $item->waktu_formatted }} WIB</span>
                        </div>
                        @endif
                        @if($item->tempat)
                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                            <span class="line-clamp-1">{{ $item->tempat }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
