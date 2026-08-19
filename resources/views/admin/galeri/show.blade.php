@extends('layouts.admin')

@section('title', $album->judul)

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.galeri.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div class="flex-1 min-w-0">
        <h1 class="text-2xl font-bold text-slate-900 truncate">{{ $album->judul }}</h1>
        <p class="text-sm text-slate-500">
            @if($album->tanggal){{ \Carbon\Carbon::parse($album->tanggal)->isoFormat('D MMMM Y') }} · @endif
            {{ $album->fotos->count() }} foto
        </p>
    </div>
    <a href="{{ route('galeri.show', $album->id) }}" target="_blank" class="btn-secondary text-xs whitespace-nowrap">Lihat Publik</a>
    <a href="{{ route('admin.galeri.edit', $album->id) }}" class="btn-soft-yellow whitespace-nowrap">Edit Album</a>
</div>

@if($album->deskripsi)
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <p class="text-sm text-slate-600 leading-relaxed">{{ $album->deskripsi }}</p>
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <h2 class="text-base font-bold text-slate-900 mb-1">Tambah Foto</h2>
    <p class="text-xs text-slate-500 mb-4">Tambahkan foto baru ke album ini.</p>
    <form action="{{ route('admin.galeri.update', $album->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
        @csrf @method('PUT')
        <input type="hidden" name="judul" value="{{ $album->judul }}">
        <input type="file" name="fotos[]" accept="image/*" multiple class="input-field flex-1 @error('fotos.*') input-error @enderror">
        <button type="submit" class="btn-primary whitespace-nowrap">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Upload Foto
        </button>
    </form>
    @error('fotos.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

@if($album->fotos->count() > 0)
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($album->fotos as $foto)
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden card-hover group relative">
        <a href="{{ asset('storage/'.$foto->foto) }}" target="_blank" class="block h-40 overflow-hidden">
            <img src="{{ asset('storage/'.$foto->foto) }}" alt="Foto #{{ $foto->id }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </a>
        <div class="p-3 flex items-center justify-between gap-2">
            <span class="text-xs text-slate-500 truncate">Foto #{{ $foto->id }}</span>
            <form action="{{ route('admin.galeri.foto.destroy', [$album->id, $foto->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-soft-red p-1.5">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="image" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada foto di album ini</p>
    <p class="text-slate-400 text-sm mt-1">Unggah foto melalui form di atas.</p>
</div>
@endif
@endsection
