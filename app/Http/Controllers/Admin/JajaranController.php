<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JajaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengurus::whereIn('kategori', ['seksi', 'rt']);

        if ($filter = $request->get('filter')) {
            if ($filter === 'seksi') {
                $query->where('kategori', 'seksi');
            } elseif ($filter === 'rt') {
                $query->where('kategori', 'rt');
            }
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('organisasi', 'like', "%{$search}%")
                    ->orWhere('rt', 'like', "%{$search}%");
            });
        }

        $pengurus = $query->latest()->paginate(10)->withQueryString();

        return view('admin.jajaran.index', compact('pengurus'));
    }

    public function create()
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();
        $daftarSeksi = ['Agama', 'Kamtibmas', 'Humas', 'Lingkungan', 'Pembangunan', 'PKK/Posyandu', 'Pemuda'];

        return view('admin.jajaran.create', compact('daftarRt', 'daftarSeksi'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:seksi,rt',
            'seksi' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:3',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data['kategori'] = $data['tipe'];
        $data['jabatan'] = $data['tipe'] === 'rt' ? 'Ketua RT' : 'Anggota';
        if ($data['tipe'] === 'seksi') {
            $data['organisasi'] = $data['seksi'];
        } else {
            $data['organisasi'] = null;
        }
        unset($data['tipe'], $data['seksi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus = Pengurus::create($data);

        $name = $pengurus->nama;
        ActivityLog::log('create', $pengurus, $name, null, $pengurus->only([
            'nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori',
        ]));

        return redirect()->route('admin.jajaran.index')->with('success', 'Data jajaran berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        return view('admin.jajaran.show', compact('pengurus'));
    }

    public function edit(Pengurus $pengurus)
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();
        $daftarSeksi = ['Agama', 'Kamtibmas', 'Humas', 'Lingkungan', 'Pembangunan', 'PKK/Posyandu', 'Pemuda'];

        return view('admin.jajaran.edit', compact('pengurus', 'daftarRt', 'daftarSeksi'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:seksi,rt',
            'seksi' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:3',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori']);

        $data['kategori'] = $data['tipe'];
        $data['jabatan'] = $data['tipe'] === 'rt' ? 'Ketua RT' : 'Anggota';
        if ($data['tipe'] === 'seksi') {
            $data['organisasi'] = $data['seksi'];
        } else {
            $data['organisasi'] = null;
        }
        unset($data['tipe'], $data['seksi']);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus->update($data);
        $newName = $pengurus->nama;

        ActivityLog::log('update', $pengurus, $newName, $old, $pengurus->only(array_keys($data)));

        return redirect()->route('admin.jajaran.index')->with('success', 'Data jajaran berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori']);
        $name = $pengurus->nama;

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        ActivityLog::log('delete', $pengurus, $name, $old, null);

        $pengurus->delete();

        return redirect()->route('admin.jajaran.index')->with('success', 'Data jajaran berhasil dihapus.');
    }
}
