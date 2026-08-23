@extends('layouts.admin')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.berita.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Kegiatan</h1>
        <p class="text-sm text-slate-500">Perbarui data kegiatan</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="{{ route('admin.kegiatan.update', $kegiatan) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
            <p class="text-sm font-semibold text-red-700 mb-1.5 flex items-center gap-1.5">
                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                Periksa kembali isian berikut:
            </p>
            <ul class="list-disc list-inside text-xs text-red-600 space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" class="input-field @error('nama_kegiatan') input-error @enderror">
            @error('nama_kegiatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="input-field">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <p class="block text-sm font-semibold text-slate-700 mb-1">Waktu Pelaksanaan</p>
            <p class="text-xs text-slate-400 mb-3">Kapan kegiatan ini akan dilaksanakan.</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="input-field @error('tanggal') input-error @enderror">
                    @error('tanggal')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jam Mulai</label>
                    <input type="time" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" class="input-field">
                    <p class="text-xs text-slate-400 mt-1">Kosongi jika jam belum ditentukan.</p>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tempat</label>
            <input type="text" name="tempat" value="{{ old('tempat', $kegiatan->tempat) }}" class="input-field">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" class="input-field @error('status') input-error @enderror">
                <option value="akan_datang" @selected(old('status', $kegiatan->status)=='akan_datang')>Akan Datang</option>
                <option value="selesai" @selected(old('status', $kegiatan->status)=='selesai')>Selesai</option>
                <option value="dibatalkan" @selected(old('status', $kegiatan->status)=='dibatalkan')>Dibatalkan</option>
            </select>
            @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        @if($kegiatan->foto)
        <div class="mb-4">
            <p class="text-sm font-medium text-slate-700 mb-2">Foto Saat Ini</p>
            <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="Foto" class="w-48 h-32 object-cover rounded-xl border border-slate-200">
        </div>
        @endif

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto</label>
            <input type="file" name="foto" accept="image/*" class="input-field @error('foto') input-error @enderror">
            @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="{{ route('admin.berita.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
