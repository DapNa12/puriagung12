@extends('layouts.public')

@section('title', 'Kegiatan')
@section('meta_description', 'Agenda dan kegiatan di lingkungan Puri Agung Permai RW12. Informasi acara dan agenda warga.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis, agenda kegiatan warga, acara rw 12, kegiatan lingkungan')
@section('og_title', 'Kegiatan - Puri Agung Permai RW12')
@section('og_description', 'Agenda dan kegiatan di lingkungan Puri Agung Permai RW12.')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Kegiatan RW</h1>
        <p class="text-slate-500 mt-2">Agenda dan acara di lingkungan Puri Agung Permai RW12</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kegiatan as $item)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            @if($item->foto)
            <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_kegiatan }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                <i data-lucide="calendar" class="w-12 h-12 text-rose-300"></i>
            </div>
            @endif
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                        {{ $item->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : ($item->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $item->status === 'akan_datang' ? 'bg-blue-500' : ($item->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500') }}"></span>
                        {{ $item->status === 'akan_datang' ? 'Akan Datang' : ucfirst($item->status) }}
                    </span>
                </div>
                <h3 class="font-bold text-slate-900 mb-2 break-words">{{ $item->nama_kegiatan }}</h3>
                <div class="space-y-1.5 text-sm text-slate-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 flex-shrink-0"></i>
                        <span>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</span>
                    </div>
                    @if($item->waktu)
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>{{ $item->waktu_formatted }} WIB</span>
                    </div>
                    @endif
                    @if($item->tempat)
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>{{ $item->tempat }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16">
            <i data-lucide="calendar" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
            <p class="text-slate-500">Belum ada kegiatan.</p>
        </div>
        @endforelse
    </div>

    @if($kegiatan->hasPages())
    <div class="mt-8">
        {{ $kegiatan->links() }}
    </div>
    @endif
</div>
@endsection
