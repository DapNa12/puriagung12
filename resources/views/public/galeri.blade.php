@extends('layouts.public')

@section('title', 'Galeri')
@section('meta_description', 'Galeri foto kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, rw 12 tangerang, website rw tangerang, perumahan puri agung permai, puri agung permai pasar kemis, galeri foto warga, dokumentasi kegiatan rw 12')
@section('og_title', 'Galeri - Puri Agung Permai RW12')
@section('og_description', 'Galeri foto kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12.')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Galeri Momen</h1>
        <p class="text-slate-500 mt-2">Dokumentasi kegiatan dan momen-momen di lingkungan Puri Agung Permai RW12</p>
    </div>

    @if($albums->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($albums as $item)
        <a href="{{ route('galeri.show', $item->id) }}" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-200">
            <div class="relative h-52 overflow-hidden">
                @if($item->cover)
                <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <i data-lucide="image" class="w-12 h-12 text-rose-300"></i>
                </div>
                @endif
                <span class="absolute top-3 right-3 bg-black/60 text-white text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm">
                    {{ $item->fotos_count }} foto
                </span>
            </div>
            <div class="p-5">
                <h2 class="font-bold text-slate-900 mb-1 group-hover:text-rose-600 transition-colors">{{ $item->judul }}</h2>
                <p class="text-xs text-slate-500">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') : \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</p>
            </div>
        </a>
        @endforeach
    </div>

    @if($albums->hasPages())
    <div class="mt-8">
        {{ $albums->onEachSide(1)->links() }}
    </div>
    @endif
    @else
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada momen</p>
        <p class="text-slate-400 text-sm mt-1">Momen kegiatan akan tampil di sini.</p>
    </div>
    @endif
</div>
@endsection
