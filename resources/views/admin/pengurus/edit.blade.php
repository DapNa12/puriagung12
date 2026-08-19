@extends('layouts.admin')

@section('title', 'Edit Pengurus')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.pengurus.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengurus</h1>
        <p class="text-sm text-slate-500">Perbarui data pengurus</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-lg">
    <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}" placeholder="Nama lengkap pengurus" class="input-field @error('nama') input-error @enderror">
            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">RT</label>
            <input type="text" name="rt" list="rt-list" value="{{ old('rt', $pengurus->rt) }}" placeholder="Contoh: 001" maxlength="3" class="input-field @error('rt') input-error @enderror">
            <datalist id="rt-list">
                @foreach($daftarRt as $rt)
                <option value="{{ $rt }}">
                @endforeach
            </datalist>
            @error('rt')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-400 mt-1">Nomor RT tempat pengurus bertugas. Kosongi untuk pengurus RW.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
            <select name="jabatan" class="input-field @error('jabatan') input-error @enderror">
                @php $opsiJabatan = ['Ketua RT', 'Sekretaris RT', 'Bendahara RT', 'Ketua RW', 'Wakil Ketua', 'Sekretaris', 'Bendahara']; @endphp
                @if($pengurus->jabatan && !in_array($pengurus->jabatan, $opsiJabatan))
                <option value="{{ $pengurus->jabatan }}" @selected(old('jabatan', $pengurus->jabatan)==$pengurus->jabatan)>{{ $pengurus->jabatan }} (kustom)</option>
                @endif
                @foreach($opsiJabatan as $opsi)
                <option value="{{ $opsi }}" @selected(old('jabatan', $pengurus->jabatan)==$opsi)>{{ $opsi }}</option>
                @endforeach
            </select>
            @error('jabatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Mulai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_mulai" value="{{ old('periode_mulai', $pengurus->periode_mulai) }}" class="input-field @error('periode_mulai') input-error @enderror">
                @error('periode_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Selesai</label>
                <input type="date" name="periode_selesai" value="{{ old('periode_selesai', $pengurus->periode_selesai) }}" class="input-field">
                <p class="text-xs text-slate-400 mt-1">Kosongi jika masih menjabat</p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            @if($pengurus->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$pengurus->foto) }}" class="w-20 h-20 object-cover rounded-xl border border-slate-200">
                <p class="text-xs text-slate-400 mt-1">Foto saat ini</p>
            </div>
            @endif
            <input type="file" name="foto" accept="image/*" class="input-field @error('foto') input-error @enderror">
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB. Kosongi jika tidak ingin mengubah foto.</p>
            @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="{{ route('admin.pengurus.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
