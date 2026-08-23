<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKegiatanRequest;
use App\Models\ActivityLog;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KegiatanController extends Controller
{
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(StoreKegiatanRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-kegiatan', 'public');
        }

        $kegiatan = Kegiatan::create($data);

        ActivityLog::log('create', $kegiatan, $kegiatan->nama_kegiatan, null, $kegiatan->only([
            'nama_kegiatan', 'deskripsi', 'tanggal', 'waktu', 'tempat', 'status',
        ]));

        return redirect()->route('admin.berita.index')->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('user');

        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'nama_kegiatan' => [
                'required', 'string', 'max:255',
                Rule::unique('kegiatan')->ignore($kegiatan->id)
                    ->where(fn ($q) => $q->where('tanggal', $request->tanggal)),
            ],
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'tempat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:akan_datang,selesai,dibatalkan',
        ]);

        $old = $kegiatan->only(['nama_kegiatan', 'deskripsi', 'tanggal', 'waktu', 'tempat', 'status']);

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-kegiatan', 'public');
        }

        $kegiatan->update($data);

        ActivityLog::log('update', $kegiatan, $kegiatan->nama_kegiatan, $old, $kegiatan->only(array_keys($data)));

        return redirect()->route('admin.berita.index')->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $old = $kegiatan->only(['nama_kegiatan', 'deskripsi', 'tanggal', 'waktu', 'tempat', 'status']);

        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        ActivityLog::log('delete', $kegiatan, $kegiatan->nama_kegiatan, $old, null);

        $kegiatan->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
