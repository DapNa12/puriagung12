@extends('layouts.admin')

@section('title', 'Tambah UMKM')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.umkm.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Tambah UMKM</h1>
        <p class="text-sm text-slate-500">Tambah data UMKM warga baru</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-2xl">
    <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Usaha <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama usaha / toko" class="input-field @error('nama') input-error @enderror">
                @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="input-field @error('kategori') input-error @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(\App\Models\Umkm::$kategoriList as $kat)
                    <option value="{{ $kat }}" @selected(old('kategori')==$kat)>{{ $kat }}</option>
                    @endforeach
                </select>
                @error('kategori')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Pemilik <span class="text-red-500">*</span></label>
                <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}" placeholder="Nama pemilik usaha" class="input-field @error('nama_pemilik') input-error @enderror">
                @error('nama_pemilik')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat usaha..." class="input-field @error('deskripsi') input-error @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat usaha" class="input-field @error('alamat') input-error @enderror">
                @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">RT <span class="text-red-500">*</span></label>
                <input type="text" name="rt" list="rt-list" value="{{ old('rt') }}" placeholder="Contoh: 001" maxlength="3" class="input-field @error('rt') input-error @enderror">
                <datalist id="rt-list">
                    @foreach($daftarRt as $rt)
                    <option value="{{ $rt }}">
                    @endforeach
                </datalist>
                @error('rt')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="input-field @error('no_hp') input-error @enderror">
                @error('no_hp')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jam Operasional</label>
                <input type="text" name="jam_operasional" value="{{ old('jam_operasional') }}" placeholder="Contoh: 08.00 - 17.00" class="input-field @error('jam_operasional') input-error @enderror">
                @error('jam_operasional')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1">Link Google Maps</label>
                <input type="url" name="maps_link" value="{{ old('maps_link') }}" placeholder="https://maps.app.goo.gl/..." class="input-field @error('maps_link') input-error @enderror">
                @error('maps_link')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1">Foto Usaha</label>
                <input type="file" name="foto" accept="image/*" class="input-field @error('foto') input-error @enderror">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Simpan</button>
            <a href="{{ route('admin.umkm.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
