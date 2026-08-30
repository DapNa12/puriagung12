@extends('layouts.public')

@section('title', 'Jajaran Pengurus & RT')
@section('meta_description', 'Jajaran pengurus seksi dan ketua RT di Puri Agung Permai RW12.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis, ketua rt puri agung permai, seksi pengurus rw 12, daftar ketua rt')
@section('og_title', 'Jajaran Pengurus & RT - Puri Agung Permai RW12')
@section('og_description', 'Jajaran pengurus seksi dan ketua RT di lingkungan RW 12 Puri Agung Permai.')

@section('content')
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Jajaran Pengurus & RT</h1>
        <p class="mt-3 text-slate-600 text-base md:text-lg">
            Jajaran pengurus seksi dan ketua RT{{ $tahunMulai ? ' masa bakti ' . $tahunMulai . ' - ' . ($tahunSelesai ?: 'Sekarang') : '' }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8 md:py-14">

    {{-- SEKSI SECTION --}}
    <div class="mb-14">
        <div class="flex items-center gap-4 mb-8">
            <div class="flex-1 h-px bg-slate-200"></div>
            <span class="px-4 py-1.5 rounded-full bg-blue-600 text-white text-sm font-bold shadow-sm">Seksi-Seksi</span>
            <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        @php
        $seksiColors = [
            'Agama'         => ['bg' => 'from-emerald-100 to-emerald-50', 'text' => 'text-emerald-700', 'badge' => 'bg-emerald-600', 'initial' => 'from-emerald-200 to-emerald-100'],
            'Kamtibmas'     => ['bg' => 'from-blue-100 to-blue-50', 'text' => 'text-blue-700', 'badge' => 'bg-blue-600', 'initial' => 'from-blue-200 to-blue-100'],
            'Humas'         => ['bg' => 'from-violet-100 to-violet-50', 'text' => 'text-violet-700', 'badge' => 'bg-violet-600', 'initial' => 'from-violet-200 to-violet-100'],
            'Lingkungan'    => ['bg' => 'from-amber-100 to-amber-50', 'text' => 'text-amber-700', 'badge' => 'bg-amber-600', 'initial' => 'from-amber-200 to-amber-100'],
            'Pembangunan'   => ['bg' => 'from-rose-100 to-rose-50', 'text' => 'text-rose-700', 'badge' => 'bg-rose-600', 'initial' => 'from-rose-200 to-rose-100'],
            'PKK/Posyandu'  => ['bg' => 'from-pink-100 to-pink-50', 'text' => 'text-pink-700', 'badge' => 'bg-pink-600', 'initial' => 'from-pink-200 to-pink-100'],
            'Pemuda'        => ['bg' => 'from-cyan-100 to-cyan-50', 'text' => 'text-cyan-700', 'badge' => 'bg-cyan-600', 'initial' => 'from-cyan-200 to-cyan-100'],
        ];
        @endphp

        @if($seksi->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
            <i data-lucide="layout-grid" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
            <p class="text-slate-400 font-medium">Belum ada data seksi</p>
        </div>
        @else
        {{-- Mobile: Vertical stack --}}
        <div class="md:hidden space-y-4 max-w-3xl mx-auto">
            @foreach($seksiList as $namaSeksi)
            @php $anggota = $seksi->get($namaSeksi); $w = $seksiColors[$namaSeksi] ?? ['bg' => 'from-slate-100 to-slate-50', 'text' => 'text-slate-700', 'badge' => 'bg-slate-600', 'initial' => 'from-slate-200 to-slate-100']; @endphp
            <div class="bg-white rounded-xl border border-slate-200 p-4">
                <span class="px-3 py-1 rounded-full {{ $w['badge'] }} text-white text-xs font-bold mb-3 inline-block">{{ $namaSeksi }}</span>
                <div class="space-y-2">
                    @if($anggota)
                    @foreach($anggota as $p)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                            @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gradient-to-br {{ $w['initial'] }} flex items-center justify-center">
                                <span class="text-sm font-bold {{ $w['text'] }}">{{ substr($p->nama ?? '?', 0, 1) }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-slate-900 truncate">{{ $p->nama ?? '-' }}</h3>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-xs text-slate-400">Belum terisi</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Desktop: Grid boxes --}}
        <div class="hidden md:flex flex-wrap justify-center gap-4 max-w-5xl mx-auto">
            @foreach($seksiList as $namaSeksi)
            @php $anggota = $seksi->get($namaSeksi); $w = $seksiColors[$namaSeksi] ?? ['bg' => 'from-slate-100 to-slate-50', 'text' => 'text-slate-700', 'badge' => 'bg-slate-600', 'initial' => 'from-slate-200 to-slate-100']; @endphp
            <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 shrink-0 w-full md:w-[calc(33.333%-11px)]">
                <span class="px-3 py-1 rounded-full {{ $w['badge'] }} text-white text-xs font-bold mb-4 inline-block">{{ $namaSeksi }}</span>
                <div class="space-y-3">
                    @if($anggota)
                    @foreach($anggota as $p)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                            @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gradient-to-br {{ $w['initial'] }} flex items-center justify-center">
                                <span class="text-sm font-bold {{ $w['text'] }}">{{ substr($p->nama ?? '?', 0, 1) }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-slate-900 truncate">{{ $p->nama ?? '-' }}</h3>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-xs text-slate-400">Belum terisi</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- RT SECTION --}}
    <div>
        <div class="flex items-center gap-4 mb-8">
            <div class="flex-1 h-px bg-slate-200"></div>
            <span class="px-4 py-1.5 rounded-full bg-rose-600 text-white text-sm font-bold shadow-sm">Ketua-Ketua RT</span>
            <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        @php $semuaRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT)); @endphp

        {{-- Mobile: Vertical list --}}
        <div class="md:hidden space-y-3 max-w-3xl mx-auto">
            @foreach($semuaRt as $nomorRt)
            @php $ketua = $rt->get($nomorRt); @endphp
            <div class="flex items-center gap-4 bg-white rounded-xl border border-slate-200 p-4">
                <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-rose-100 flex items-center justify-center">
                    <span class="text-sm font-bold text-rose-700">{{ $nomorRt }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-rose-600 mb-0.5">Ketua RT {{ $nomorRt }}</span>
                    <h3 class="text-sm font-bold text-slate-900 truncate">{{ $ketua->nama ?? '-' }}</h3>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Desktop: Grid boxes --}}
        <div class="hidden md:grid grid-cols-3 gap-4 max-w-4xl mx-auto">
            @foreach($semuaRt as $nomorRt)
            @php $ketua = $rt->get($nomorRt); @endphp
            <div class="bg-white rounded-xl border border-slate-200 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="w-16 h-16 bg-rose-100 rounded-full mx-auto mb-3 flex items-center justify-center border-4 border-white shadow-inner">
                    <span class="text-xl font-bold text-rose-700">{{ $nomorRt }}</span>
                </div>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-rose-500 mb-1">Ketua RT</span>
                <h3 class="text-sm font-bold text-slate-900">{{ $ketua->nama ?? '-' }}</h3>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
