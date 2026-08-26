@extends('layouts.public')

@section('title', 'UMKM Warga')
@section('meta_description', 'Daftar Usaha Mikro Kecil dan Menengah (UMKM) warga Puri Agung Permai RW12. Temukan usaha lokal di lingkungan Anda.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis, umkm pasar kemis, usaha warga tangerang, jasa lokal, kuliner puri agung permai, umkm gelam jaya, usaha kecil tangerang')
@section('og_title', 'UMKM Warga - Puri Agung Permai RW12')
@section('og_description', 'Daftar UMKM warga Puri Agung Permai RW12. Dukung usaha lokal lingkungan Anda.')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">UMKM Warga</h1>
        <p class="text-slate-500 mt-2">Temukan dan dukung usaha lokal warga Puri Agung Permai RW12</p>
    </div>

    <form method="GET" class="bg-white p-4 md:p-6 rounded-2xl border border-slate-200 shadow-sm mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-96">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama usaha atau pemilik..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 text-sm text-slate-800 focus:outline-none focus:border-rose-500 focus:bg-white transition-all shadow-inner">
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5"></i>
        </div>

        <div class="flex flex-wrap md:flex-nowrap items-center gap-3 w-full md:w-auto">
            <select name="kategori" onchange="this.form.submit()" class="w-full md:w-48 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 font-medium focus:outline-none focus:border-rose-500 focus:bg-white transition-all">
                <option value="">Semua Kategori</option>
                @foreach($daftarKategori as $kat)
                <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
                @endforeach
            </select>

            @if(request('search') || request('kategori'))
            <a href="{{ route('umkm') }}" class="px-4 py-3 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors shrink-0">
                Reset Filter
            </a>
            @endif
        </div>
    </form>

    @if($umkm->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($umkm as $item)
        <a href="{{ route('umkm.show', $item->slug) }}" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            <div class="relative h-48 overflow-hidden">
                @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <i data-lucide="store" class="w-12 h-12 text-rose-300"></i>
                </div>
                @endif
                <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold px-2.5 py-1 rounded-lg">
                    {{ $item->kategori }}
                </span>
            </div>
            <div class="p-5">
                <h2 class="font-bold text-slate-900 mb-1 group-hover:text-rose-600 transition-colors">{{ $item->nama }}</h2>
                <p class="text-xs text-slate-500 mb-2">Pemilik: {{ $item->nama_pemilik }}</p>
                <p class="text-sm text-slate-600 line-clamp-2 break-words">{{ Str::limit($item->deskripsi, 100) }}</p>
                <div class="flex items-center gap-3 mt-3 text-xs text-slate-400">
                    @if($item->jam_operasional)
                    <span class="flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        {{ $item->jam_operasional }}
                    </span>
                    @endif
                    <span class="flex items-center gap-1">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                        RT {{ $item->rt }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if($umkm->hasPages())
    <div class="mt-8">
        {{ $umkm->onEachSide(1)->links() }}
    </div>
    @endif
    @else
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="store" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada UMKM</p>
        <p class="text-slate-400 text-sm mt-1">Data UMKM warga akan tampil di sini.</p>
    </div>
    @endif
</div>
@endsection