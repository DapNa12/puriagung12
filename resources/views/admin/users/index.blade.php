@extends('layouts.admin')

@section('title', 'Kelola User / Pengguna')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Kelola Akun Pengguna</h1>
        <p class="text-slate-500 text-sm mt-1">Daftar pengguna & pengelola sistem informasi RW12</p>
    </div>
    <div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah User
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-6">
    <div class="p-4 border-b border-slate-100 bg-slate-50/50">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="input-field max-w-xs text-sm">
            <select name="role" class="input-field max-w-xs text-sm">
                <option value="">-- Semua Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="sekretaris" {{ request('role') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="ketua_rw" {{ request('role') == 'ketua_rw' ? 'selected' : '' }}>Ketua RW</option>
            </select>
            <button type="submit" class="btn-secondary text-sm">Cari</button>
            @if(request()->anyFilled(['search', 'role']))
                <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-500 hover:text-slate-700">Reset</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $u)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-700 font-bold text-xs">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <span>{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ $u->email }}</td>
                    <td class="px-6 py-4 capitalize">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                            {{ $u->role === 'admin' ? 'bg-rose-50 text-rose-700 border border-rose-200' : ($u->role === 'ketua_rw' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                            {{ str_replace('_', ' ', $u->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($u->is_active)
                            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                                <span class="w-2 h-2 rounded-full bg-slate-300"></span> Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-soft-blue">Edit</a>
                            @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">Tidak ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-slate-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
