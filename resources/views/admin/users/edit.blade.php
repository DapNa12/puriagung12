@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900">Edit User</h1>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input-field @error('name') input-error @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="input-field @error('email') input-error @enderror">
                @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-xs font-semibold text-amber-800">Ubah Password (Opsional)</p>
                <p class="text-xs text-amber-700 mt-0.5">Biarkan kosong jika tidak ingin mengubah password user.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3">
                    <div>
                        <label class="block text-xs font-medium text-amber-900 mb-1">Password Baru</label>
                        <input type="password" name="password" class="input-field bg-white @error('password') input-error @enderror">
                        @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-amber-900 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="input-field bg-white">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role / Hak Akses</label>
                    <select name="role" required class="input-field">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="sekretaris" {{ old('role', $user->role) == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="ketua_rw" {{ old('role', $user->role) == 'ketua_rw' ? 'selected' : '' }}>Ketua RW</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Akun</label>
                    <select name="is_active" required class="input-field">
                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui User</button>
            </div>
        </form>
    </div>
</div>
@endsection
