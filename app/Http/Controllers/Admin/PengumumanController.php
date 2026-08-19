<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengumumanRequest;
use App\Models\ActivityLog;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(StorePengumumanRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-pengumuman', 'public');
        }

        $pengumuman = Pengumuman::create($data);

        ActivityLog::log('create', $pengumuman, $pengumuman->judul, null, $pengumuman->only([
            'judul', 'isi', 'tgl_mulai', 'tgl_selesai', 'status',
        ]));

        return redirect()->route('admin.berita.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        $pengumuman->load('user');

        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:kegiatan,pemberitahuan',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $old = $pengumuman->only(['judul', 'isi', 'tgl_mulai', 'tgl_selesai', 'status']);

        if ($request->hasFile('foto')) {
            if ($pengumuman->foto) {
                Storage::disk('public')->delete($pengumuman->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-pengumuman', 'public');
        } elseif ($request->boolean('remove_foto') && $pengumuman->foto) {
            Storage::disk('public')->delete($pengumuman->foto);
            $data['foto'] = null;
        }

        $pengumuman->update($data);

        ActivityLog::log('update', $pengumuman, $pengumuman->judul, $old, $pengumuman->only(array_keys($data)));

        return redirect()->route('admin.berita.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $old = $pengumuman->only(['judul', 'isi', 'tgl_mulai', 'tgl_selesai', 'status']);

        if ($pengumuman->foto) {
            Storage::disk('public')->delete($pengumuman->foto);
        }

        ActivityLog::log('delete', $pengumuman, $pengumuman->judul, $old, null);

        $pengumuman->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
