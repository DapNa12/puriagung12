@extends('layouts.admin')

@section('title', 'Jajaran & RT')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Jajaran & RT</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola seksi dan pengurus RT</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="{{ route('admin.jajaran.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah
        </a>
    </div>
</div>

<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('admin.jajaran.index') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ !request('filter') ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Semua</a>
    <a href="{{ route('admin.jajaran.index', ['filter' => 'seksi']) }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ request('filter') === 'seksi' ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Seksi</a>
    <a href="{{ route('admin.jajaran.index', ['filter' => 'rt']) }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ request('filter') === 'rt' ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">RT</a>
</div>

<form method="GET" class="mb-6">
    <div class="flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau seksi..." class="input-field pl-10">
            @if(request('filter'))<input type="hidden" name="filter" value="{{ request('filter') }}">@endif
        </div>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

@if($pengurus->count() > 0)
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Periode</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($pengurus as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <p class="text-sm font-medium text-slate-900">{{ $item->nama ?? '-' }}</p>
                    </td>
                    <td class="px-4 py-3.5">
                        @if($item->kategori === 'seksi')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">Seksi</span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 text-xs font-medium">RT</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">
                        {{ $item->kategori === 'seksi' ? $item->organisasi : 'RT '.$item->rt }}
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700 hidden sm:table-cell">{{ \Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y') }} - {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang' }}</td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.jajaran.show', $item->id) }}" class="btn-soft-blue">Detail</a>
                            <a href="{{ route('admin.jajaran.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
                            <form action="{{ route('admin.jajaran.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
    @foreach($pengurus as $item)
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start justify-between mb-2">
            <div class="flex-1 min-w-0 mr-2">
                <p class="text-sm font-semibold text-slate-900">{{ $item->nama ?? '-' }}</p>
                <p class="text-xs text-slate-500">
                    @if($item->kategori === 'seksi')
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">Seksi</span> {{ $item->organisasi }}
                    @else
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 text-xs font-medium">RT</span> RT {{ $item->rt }}
                    @endif
                </p>
            </div>
        </div>
        <p class="text-xs text-slate-500 mb-3">Periode: {{ \Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y') }} — {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang' }}</p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100 mt-2">
            <a href="{{ route('admin.jajaran.show', $item->id) }}" class="btn-soft-blue">Detail</a>
            <a href="{{ route('admin.jajaran.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
            <form action="{{ route('admin.jajaran.destroy', $item->id) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="users" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada data jajaran</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan menambahkan data seksi atau pengurus RT.</p>
    <a href="{{ route('admin.jajaran.create') }}" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah
    </a>
</div>
@endif

@if($pengurus->hasPages())
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan {{ $pengurus->firstItem() }} - {{ $pengurus->lastItem() }} dari {{ $pengurus->total() }} data</p>
    {{ $pengurus->onEachSide(1)->links() }}
</div>
@endif
@endsection
