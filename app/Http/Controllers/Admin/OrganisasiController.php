<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengurus::where('kategori', 'organisasi');

        if ($filter = $request->get('filter')) {
            $query->where('organisasi', $filter);
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('organisasi', 'like', "%{$search}%");
            });
        }

        $pengurus = $query->orderBy('organisasi')->orderBy('jabatan')->paginate(10)->withQueryString();

        return view('admin.organisasi.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.organisasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'organisasi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data['kategori'] = 'organisasi';

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus = Pengurus::create($data);

        $name = $pengurus->nama . ' - ' . $pengurus->jabatan;
        ActivityLog::log('create', $pengurus, $name, null, $pengurus->only([
            'nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori',
        ]));

        return redirect()->route('admin.organisasi.index')->with('success', 'Data organisasi berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        return view('admin.organisasi.show', compact('pengurus'));
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.organisasi.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'organisasi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori']);

        $data['kategori'] = 'organisasi';

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus->update($data);
        $newName = $pengurus->nama . ' - ' . $pengurus->jabatan;

        ActivityLog::log('update', $pengurus, $newName, $old, $pengurus->only(array_keys($data)));

        return redirect()->route('admin.organisasi.index')->with('success', 'Data organisasi berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai', 'kategori']);
        $name = $pengurus->nama . ' - ' . $pengurus->jabatan;

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        ActivityLog::log('delete', $pengurus, $name, $old, null);

        $pengurus->delete();

        return redirect()->route('admin.organisasi.index')->with('success', 'Data organisasi berhasil dihapus.');
    }
}
