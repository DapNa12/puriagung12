@extends('layouts.public')

@section('title', 'Pencarian')
@section('meta_description', 'Cari informasi seputar Puri Agung Permai RW12. Temukan berita, kegiatan, dan galeri.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Pencarian</h1>
        <form method="GET" action="{{ route('search') }}" class="relative">
            <input type="search" name="q" value="{{ $query }}" placeholder="Cari berita, kegiatan, atau galeri..."
                   class="w-full bg-white border border-slate-200 rounded-2xl px-5 py-4 pl-12 text-base text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition-all shadow-sm"
                   autofocus>
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-4 top-4.5"></i>
            <button type="submit" class="absolute right-3 top-2 bg-rose-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-rose-700 transition-colors">
                Cari
            </button>
        </form>
    </div>

    @if($query && strlen($query) < 2)
    <div class="text-center py-12">
        <i data-lucide="alert-circle" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
        <p class="text-slate-500">Masukkan minimal 2 karakter untuk pencarian.</p>
    </div>
    @elseif($query)
    <p class="text-sm text-slate-500 mb-8">
        Ditemukan <span class="font-bold text-slate-900">{{ $totalResults }}</span> hasil untuk
        "<span class="font-semibold text-rose-600">{{ $query }}</span>"
    </p>

    @if($pengumuman->count())
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="clipboard-list" class="w-5 h-5 text-rose-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Berita dan Pengumuman</h2>
            <span class="bg-rose-100 text-rose-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pengumuman->count() }}</span>
        </div>
        <div class="space-y-4">
            @foreach($pengumuman as $item)
            <a href="{{ route('pengumuman.show', $item) }}" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    @else
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center shrink-0">
                        <i data-lucide="file-text" class="w-8 h-8 text-rose-300"></i>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1 break-words">{{ $item->judul }}</h3>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2 break-words">{{ Str::limit(strip_tags($item->isi), 120) }}</p>
                        <span class="text-xs text-slate-400 mt-2 inline-block">{{ $item->created_at->isoFormat('D MMMM Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($kegiatan->count())
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="calendar-check" class="w-5 h-5 text-blue-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Kegiatan</h2>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $kegiatan->count() }}</span>
        </div>
        <div class="space-y-4">
            @foreach($kegiatan as $item)
            <a href="{{ route('kegiatan.show', $item) }}" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_kegiatan }}" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    @else
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center shrink-0">
                        <i data-lucide="calendar" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1 break-words">{{ $item->nama_kegiatan }}</h3>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full
                                {{ $item->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' }}">
                                {{ $item->status === 'akan_datang' ? 'Akan Datang' : ucfirst($item->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</p>
                        @if($item->tempat)
                        <p class="text-xs text-slate-400 mt-1">{{ $item->tempat }}</p>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($albums->count())
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="image" class="w-5 h-5 text-emerald-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Galeri</h2>
            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $albums->count() }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($albums as $item)
            <a href="{{ route('galeri.show', $item->id) }}" class="block bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="h-36 bg-slate-100 relative overflow-hidden">
                    @if($item->cover)
                    <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                        <i data-lucide="image" class="w-10 h-10 text-emerald-300"></i>
                    </div>
                    @endif
                    <span class="absolute top-2 right-2 bg-black/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $item->fotos_count }} foto</span>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1 break-words">{{ $item->judul }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if(isset($umkmResults) && $umkmResults->count())
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="store" class="w-5 h-5 text-purple-600"></i>
            <h2 class="text-xl font-bold text-slate-900">UMKM</h2>
            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $umkmResults->count() }}</span>
        </div>
        <div class="space-y-4">
            @foreach($umkmResults as $item)
            <a href="{{ route('umkm.show', $item->slug) }}" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    @else
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center shrink-0">
                        <i data-lucide="store" class="w-8 h-8 text-purple-300"></i>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1 break-words">{{ $item->nama }}</h3>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-50 text-purple-700">
                                {{ $item->kategori }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-500 line-clamp-1 break-words">{{ $item->nama_pemilik }} · RT {{ $item->rt }}</p>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-1 break-words">{{ Str::limit($item->deskripsi, 100) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($totalResults === 0)
    <div class="text-center py-16">
        <i data-lucide="search-x" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <h3 class="text-lg font-bold text-slate-700 mb-1">Tidak ada hasil ditemukan</h3>
        <p class="text-slate-500 text-sm">Coba kata kunci yang berbeda atau periksa ejaan Anda.</p>
    </div>
    @endif

    @elseif(!empty($query))
    <div class="text-center py-16">
        <i data-lucide="search" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <h3 class="text-lg font-bold text-slate-700 mb-1">Ketik kata kunci untuk mulai mencari</h3>
        <p class="text-slate-500 text-sm">Temukan berita, kegiatan, dan galeri di Puri Agung Permai RW12.</p>
    </div>
    @endif
</div>
@endsection
