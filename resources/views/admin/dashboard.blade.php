@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="text-slate-500 mt-1">Inilah ringkasan data & statistik Puri Agung Permai RW12 hari ini.</p>
    </div>
    @if(in_array($role, ['admin', 'sekretaris']))
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold shadow-sm transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            + Tambah Berita Baru
        </a>
    </div>
    @endif
</div>

<!-- Kartu Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @if(in_array($role, ['admin', 'sekretaris']))
    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Warga</span>
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-rose-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $totalWarga }}</div>
        <div class="text-sm text-slate-500 mt-1">Jiwa (statistik manual)</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Kegiatan</span>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i data-lucide="calendar" class="w-5 h-5 text-emerald-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $totalKegiatan }}</div>
        <div class="flex items-center gap-3 mt-1">
            <span class="text-sm text-slate-500">{{ $kegiatanSelesai }} selesai</span>
            @if($kegiatanMendatang > 0)
            <span class="text-sm text-amber-600 font-medium">{{ $kegiatanMendatang }} mendatang</span>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total User System</span>
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $totalUsers }}</div>
        <div class="text-sm text-slate-500 mt-1">Pengelola & Admin</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Informasi Publik</span>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <i data-lucide="megaphone" class="w-5 h-5 text-amber-600"></i>
            </div>
        </div>
        <div class="space-y-2.5">
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Pengumuman aktif</span>
                <span class="font-bold text-slate-900">{{ $pengumumanAktif }}</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Kegiatan mendatang</span>
                <span class="font-bold text-slate-900">{{ $kegiatanMendatang }}</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Kegiatan selesai</span>
                <span class="font-bold text-slate-900">{{ $kegiatanSelesai }}</span>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Pengumuman Aktif</span>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <i data-lucide="megaphone" class="w-5 h-5 text-amber-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $pengumumanAktif }}</div>
        <div class="text-sm text-slate-500 mt-1">{{ $pengumumanAktif > 0 ? 'Sedang tayang' : 'Tidak ada' }}</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kegiatan Mendatang</span>
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <i data-lucide="calendar" class="w-5 h-5 text-rose-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $kegiatanMendatang }}</div>
        <div class="text-sm text-slate-500 mt-1">Akan datang</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kegiatan Selesai</span>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $kegiatanSelesai }}</div>
        <div class="text-sm text-slate-500 mt-1">Telah dilaksanakan</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 card-hover">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Pengurus</span>
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $totalPengurus }}</div>
        <div class="text-sm text-slate-500 mt-1">Pengurus aktif</div>
    </div>
    @endif
</div>

@if(in_array($role, ['admin', 'sekretaris']))
<!-- Kelola Cepat -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Pengaturan Statistik RW & Bangunan</h3>
                <p class="text-xs text-slate-500 mt-0.5">Update statistik jumlah rumah & bangunan yang tampil live di halaman publik.</p>
            </div>
            <a href="{{ route('admin.statistik.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all shadow-sm flex-shrink-0">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                Kelola Statistik
            </a>
        </div>
        <form action="{{ route('admin.statistik-rw.update') }}" method="POST" class="mt-4 flex flex-col sm:flex-row sm:items-center gap-3">
            @csrf
            <div class="flex-1">
                <input type="number" name="jumlah_rumah_bangunan" value="{{ old('jumlah_rumah_bangunan', $statistikRw->jumlah_rumah_bangunan ?? 0) }}" class="input-field py-2 text-sm" min="0" placeholder="Jumlah rumah">
            </div>
            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm flex-shrink-0">Simpan Jumlah Rumah</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Struktur Pengurus</h3>
                <p class="text-xs text-slate-500 mt-0.5">Kelola struktur kepengurusan RT &amp; RW yang tampil live di halaman publik.</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('admin.pengurus.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah
                </a>
                <a href="{{ route('admin.pengurus.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-all shadow-sm">
                    Kelola ({{ $totalPengurus }})
                </a>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
            @forelse($pengurusList as $p)
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3">
                <p class="text-sm font-semibold text-slate-900 truncate">{{ $p->nama ?? '-' }}</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ $p->rt ? 'RT '.$p->rt.' · ' : '' }}{{ $p->jabatan }}</p>
            </div>
            @empty
            <p class="text-sm text-slate-400 sm:col-span-2">Belum ada pengurus. Klik "Tambah" untuk memulai.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Grafik & Aksi Cepat -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Jumlah Warga per RT</h2>
            <span class="text-xs text-slate-400">Total {{ $totalWarga }} jiwa</span>
        </div>
        <div class="space-y-3">
            @foreach($wargaPerRt as $rt)
            <div>
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="font-medium text-slate-700">RT {{ $rt->rt }}</span>
                    <span class="text-slate-500">{{ $rt->total }} jiwa</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full transition-all" style="width: {{ ($rt->total / $maxRt) * 100 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-3 text-center">
            <div>
                <p class="text-xl font-bold text-slate-900">{{ $wargaLaki }}</p>
                <p class="text-xs text-slate-500">Laki-laki</p>
            </div>
            <div>
                <p class="text-xl font-bold text-slate-900">{{ $wargaPerempuan }}</p>
                <p class="text-xs text-slate-500">Perempuan</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900">Aksi Cepat</h2>
                <span class="text-xs text-slate-400">Menu Pengelola</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.statistik.index') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-emerald-300 hover:bg-emerald-50 transition-all">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Statistik</span>
                </a>
                <a href="{{ route('admin.pengumuman.create') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-rose-300 hover:bg-rose-50 transition-all">
                    <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola Pengumuman</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola User</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-amber-300 hover:bg-amber-50 transition-all">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Berita</span>
                </a>
                <a href="{{ route('admin.pengurus.index') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-violet-300 hover:bg-violet-50 transition-all">
                    <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center text-violet-600">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Kelola Pengurus</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 bg-slate-50 border border-slate-200 text-slate-700 p-3 rounded-xl hover:border-rose-300 hover:bg-rose-50 transition-all">
                    <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold">Galeri</span>
                </a>
            </div>
        </div>
    </div>
</div>
@else
<!-- Informasi Terbaru (Ketua RW) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Pengumuman Terbaru</h2>
            <a href="{{ route('pengumuman') }}" class="text-xs text-rose-600 hover:text-rose-700 font-medium">Lihat Semua</a>
        </div>
        @if($recentPengumuman->count() > 0)
        <div class="space-y-3">
            @foreach($recentPengumuman as $p)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="megaphone" class="w-4 h-4 text-amber-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate">{{ $p->judul }}</p>
                    <p class="text-xs text-slate-500">{{ $p->tgl_mulai ? \Carbon\Carbon::parse($p->tgl_mulai)->isoFormat('D MMMM Y') : '-' }}</p>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded-full {{ $p->status === 'aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                    <span class="w-1 h-1 rounded-full {{ $p->status === 'aktif' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                    {{ $p->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-6">
            <p class="text-slate-400 text-sm">Belum ada pengumuman.</p>
        </div>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Kegiatan Terbaru</h2>
            <a href="{{ route('kegiatan') }}" class="text-xs text-rose-600 hover:text-rose-700 font-medium">Lihat Semua</a>
        </div>
        @if($recentKegiatan->count() > 0)
        <div class="space-y-3">
            @foreach($recentKegiatan as $k)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="calendar" class="w-4 h-4 text-rose-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate">{{ $k->nama_kegiatan }}</p>
                    <p class="text-xs text-slate-500">{{ $k->tanggal ? \Carbon\Carbon::parse($k->tanggal)->isoFormat('D MMMM Y') : '-' }}</p>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded-full {{ $k->status === 'akan_datang' ? 'bg-amber-50 text-amber-700' : ($k->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                    <span class="w-1 h-1 rounded-full {{ $k->status === 'akan_datang' ? 'bg-amber-500' : ($k->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500') }}"></span>
                    {{ $k->status === 'akan_datang' ? 'Akan Datang' : ucfirst($k->status) }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-6">
            <p class="text-slate-400 text-sm">Belum ada kegiatan.</p>
        </div>
        @endif
    </div>
</div>
@endif
@endsection
