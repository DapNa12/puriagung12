@extends('layouts.public')

@section('title', 'Struktur RW')
@section('meta_description', 'Struktur kepengurusan RW 12 Puri Agung Permai. Daftar pengurus RW dan tugas masing-masing.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis, pengurus rw 12, ketua rw 12, struktur kepengurusan rw')
@section('og_title', 'Struktur RW - Puri Agung Permai RW12')
@section('og_description', 'Struktur kepengurusan RW 12 Puri Agung Permai.')

@section('content')
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Struktur RW</h1>
        <p class="mt-3 text-slate-600 text-base md:text-lg">
            Struktur kepengurusan RW 12{{ $tahunMulai ? ' masa bakti ' . $tahunMulai . ' - ' . ($tahunSelesai ?: 'Sekarang') : '' }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8 md:py-14">
    @if($pengurusRw->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="users" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada data pengurus RW</p>
        <p class="text-slate-400 text-sm mt-1">Data akan ditampilkan setelah struktur kepengurusan RW dilengkapi melalui menu Pengurus.</p>
    </div>
    @else
    <!-- Mobile: Horizontal list -->
    <div class="md:hidden space-y-3 max-w-3xl mx-auto">
        @foreach($pengurusRw as $p)
        <div class="flex items-center gap-4 bg-white rounded-xl border border-slate-200 p-4">
            <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                @if($p->foto)
                <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama ?? 'Pengurus' }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <span class="text-lg font-bold text-rose-700">{{ substr($p->nama ?? '?', 0, 1) }}</span>
                </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <span class="block text-[10px] font-bold uppercase tracking-wider text-rose-600 mb-0.5">{{ $p->jabatan }}</span>
                <h3 class="text-sm font-bold text-slate-900 truncate">{{ $p->nama ?? '-' }}</h3>
                @if($p->periode_mulai)
                <p class="text-xs text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($p->periode_mulai)->format('Y') }} - {{ $p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang' }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Desktop: Ketua RW centered --}}
    @php
    $ketuaRW = $pengurusRw->firstWhere('jabatan', 'Ketua RW');
    $otherPengurus = $pengurusRw->where('jabatan', '!=', 'Ketua RW');
    @endphp
    @if($ketuaRW)
    <div class="hidden md:flex justify-center">
        <div class="rw-card p-6 text-center max-w-xs">
            @if($ketuaRW->foto)
            <img src="{{ asset('storage/'.$ketuaRW->foto) }}" class="w-28 h-28 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
            @else
            <div class="w-28 h-28 bg-rose-100 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-white shadow-inner">
                <span class="text-3xl font-bold text-rose-700">{{ substr($ketuaRW->nama ?? '?', 0, 1) }}</span>
            </div>
            @endif
            <h3 class="text-lg font-bold text-slate-900">{{ $ketuaRW->nama ?? '-' }}</h3>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold mt-2">{{ $ketuaRW->jabatan }}</span>
            @if($ketuaRW->periode_mulai)
            <p class="text-xs text-slate-400 mt-2">{{ \Carbon\Carbon::parse($ketuaRW->periode_mulai)->format('Y') }} - {{ $ketuaRW->periode_selesai ? \Carbon\Carbon::parse($ketuaRW->periode_selesai)->format('Y') : 'Sekarang' }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- Desktop: Grid pengurus lainnya --}}
    @if($otherPengurus->isNotEmpty())
    <div class="hidden md:flex flex-wrap justify-center gap-6 mt-10 mb-2">
        @foreach($otherPengurus as $p)
        <div class="rw-card p-6 text-center shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(25%-18px)]">
            @if($p->foto)
            <img src="{{ asset('storage/'.$p->foto) }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
            @else
            <div class="w-24 h-24 bg-rose-100 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-white shadow-inner">
                <span class="text-3xl font-bold text-rose-700">{{ substr($p->nama ?? '?', 0, 1) }}</span>
            </div>
            @endif
            <h3 class="text-lg font-bold text-slate-900">{{ $p->nama ?? '-' }}</h3>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold mt-2">{{ $p->jabatan }}</span>
            @if($p->periode_mulai)
            <p class="text-xs text-slate-400 mt-2">{{ \Carbon\Carbon::parse($p->periode_mulai)->format('Y') }} - {{ $p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang' }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    @endif
</div>
@endsection