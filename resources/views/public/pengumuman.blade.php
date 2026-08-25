@extends('layouts.public')

@section('title', 'Berita dan Pengumuman')
@section('meta_description', 'Berita dan pengumuman terkini dari Puri Agung Permai RW12. Informasi penting seputar lingkungan warga.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, pengumuman rw 12, berita warga, info lingkungan')
@section('og_title', 'Berita dan Pengumuman - Puri Agung Permai RW12')
@section('og_description', 'Berita dan pengumuman terkini dari Puri Agung Permai RW12.')

@section('content')
<!-- Header Section -->
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-rose-100 text-rose-800 rounded-full text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse" aria-hidden="true"></span> Informasi Terkini RW 12
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Berita &amp; Informasi</h1>
            <p class="mt-3 text-slate-600 text-base md:text-lg">Baca berita, agenda kegiatan, dan informasi penting seputar lingkungan Puri Agung Permai RW 12.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Filter & Search Controls (Inspired by rw-12.id) -->
    <form method="GET" action="{{ route('pengumuman') }}" class="bg-white p-4 md:p-6 rounded-2xl border border-slate-200 shadow-sm mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-96">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari berita atau pengumuman..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 text-sm text-slate-800 focus:outline-none focus:border-rose-500 focus:bg-white transition-all shadow-inner">
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5"></i>
        </div>

        <div class="flex flex-wrap md:flex-nowrap items-center gap-3 w-full md:w-auto">
            <select name="kategori" onchange="this.form.submit()" class="w-full md:w-48 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 font-medium focus:outline-none focus:border-rose-500 focus:bg-white transition-all">
                <option value="">Semua Kategori</option>
                <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="pemberitahuan" {{ request('kategori') == 'pemberitahuan' ? 'selected' : '' }}>Pemberitahuan</option>
            </select>

            @if(request('search') || request('kategori'))
                <a href="{{ route('pengumuman') }}" class="px-4 py-3 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors shrink-0">
                    Reset Filter
                </a>
            @endif
        </div>
    </form>

    <!-- Results Counter -->
    <div class="flex items-center justify-between mb-6">
        <p class="text-xs md:text-sm font-medium text-slate-500">
            Menampilkan <span class="font-bold text-slate-900">{{ $pengumuman->count() }}</span> dari <span class="font-bold text-slate-900">{{ $pengumuman->total() }}</span> berita
        </p>
    </div>

    <!-- Main News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($pengumuman as $item)
        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">
            <div class="relative h-56 bg-slate-100 overflow-hidden">
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-rose-900 via-rose-800 to-teal-900 flex items-center justify-center p-6 text-center group-hover:scale-105 transition-transform duration-500">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                            <i data-lucide="file-text" class="w-6 h-6 text-rose-200"></i>
                        </div>
                    </div>
                @endif
                
                <!-- Category Badge -->
                <div class="absolute top-3 left-3">
                    <span class="px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white font-semibold text-[11px] rounded-lg uppercase tracking-wider shadow-md">
                        {{ $item->kategori ? ucfirst($item->kategori) : 'Berita RW' }}
                    </span>
                </div>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3 font-medium">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-rose-600"></i>
                            {{ $item->created_at ? $item->created_at->isoFormat('D MMMM Y') : date('d/m/Y') }}
                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1">
                            Sekretariat RW 12
                        </span>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug mb-3 break-words">
                        <a href="{{ route('pengumuman.show', $item) }}">{{ $item->judul }}</a>
                    </h2>

                    <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-4 break-words">
                        {{ Str::limit(strip_tags($item->isi), 140) }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('pengumuman.show', $item) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-800 group-hover:gap-2.5 transition-all">
                        Baca Selengkapnya
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="file-text" class="w-8 h-8 text-slate-400"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak Berita Ditemukan</h3>
            <p class="text-slate-500 text-sm mt-1">Coba kata kunci atau filter lain untuk menemukan berita yang Anda cari.</p>
        </div>
        @endforelse
    </div>

    @if($pengumuman->hasPages())
    <div class="mt-12">
        {{ $pengumuman->links() }}
    </div>
    @endif
</div>
@endsection
