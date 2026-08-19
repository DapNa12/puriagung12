@extends('layouts.admin')

@section('title', 'Tambah Album Galeri')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.galeri.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Tambah Album Galeri</h1>
        <p class="text-sm text-slate-500">Buat album baru untuk menyimpan momen kegiatan</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Album <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: 17 Agustusan 2026" class="input-field @error('judul') input-error @enderror">
            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="input-field" placeholder="Cerita singkat momen tersebut">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Momen</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="input-field">
            <p class="text-xs text-slate-400 mt-1">Kosongi jika tidak perlu.</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto <span class="text-red-500">*</span></label>
            <input type="file" name="fotos[]" accept="image/*" multiple class="input-field @error('fotos') input-error @enderror @error('fotos.*') input-error @enderror">
            @error('fotos')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            @error('fotos.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maksimal 5MB per foto. Bisa pilih banyak sekaligus.</p>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Simpan</button>
            <a href="{{ route('admin.galeri.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
