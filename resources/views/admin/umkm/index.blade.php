@extends('layouts.admin')

@section('title', 'UMKM')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">UMKM</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola data Usaha Mikro Kecil dan Menengah warga</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="{{ route('admin.umkm.index') }}" class="btn-secondary text-xs">Semua</a>
        <a href="{{ route('admin.umkm.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah UMKM
        </a>
    </div>
</div>

<form method="GET" class="mb-6">
    <div class="flex flex-wrap gap-2">
        <div class="relative flex-1 min-w-[200px] max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama usaha atau pemilik..." class="input-field pl-10">
        </div>
        <select name="kategori" onchange="this.form.submit()" class="input-field w-auto">
            <option value="">Semua Kategori</option>
            @foreach(\App\Models\Umkm::$kategoriList as $kat)
            <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

@if($umkm->count() > 0)
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Usaha</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">RT</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($umkm as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="store" class="w-5 h-5 text-rose-400"></i>
                            </div>
                            @endif
                            <p class="text-sm font-medium text-slate-900">{{ $item->nama }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">{{ $item->kategori }}</td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">{{ $item->nama_pemilik }}</td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">RT {{ $item->rt }}</td>
                    <td class="px-4 py-3.5">
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full {{ $item->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.umkm.show', $item->id) }}" class="btn-soft-blue">Detail</a>
                            <a href="{{ route('admin.umkm.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
                            <form action="{{ route('admin.umkm.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="sm:hidden space-y-3">
    @foreach($umkm as $item)
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start gap-3 mb-2">
            @if($item->foto)
            <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
            @else
            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center flex-shrink-0">
                <i data-lucide="store" class="w-6 h-6 text-rose-400"></i>
            </div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900">{{ $item->nama }}</p>
                <p class="text-xs text-slate-500">{{ $item->kategori }} · RT {{ $item->rt }}</p>
            </div>
            <span class="inline-flex items-center gap-1 text-[10px] font-medium px-2 py-0.5 rounded-full {{ $item->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
        <p class="text-xs text-slate-500 mb-3">Pemilik: {{ $item->nama_pemilik }}</p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100">
            <a href="{{ route('admin.umkm.show', $item->id) }}" class="btn-soft-blue">Detail</a>
            <a href="{{ route('admin.umkm.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
            <form action="{{ route('admin.umkm.destroy', $item->id) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="store" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada UMKM</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan menambahkan data UMKM warga.</p>
    <a href="{{ route('admin.umkm.create') }}" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah UMKM
    </a>
</div>
@endif

@if($umkm->hasPages())
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan {{ $umkm->firstItem() }} - {{ $umkm->lastItem() }} dari {{ $umkm->total() }} data</p>
    {{ $umkm->onEachSide(1)->links() }}
</div>
@endif
@endsection
