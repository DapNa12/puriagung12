<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUmkmRequest;
use App\Models\ActivityLog;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query();
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_pemilik', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }
        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }
        $umkm = $query->latest()->paginate(10)->withQueryString();

        return view('admin.umkm.index', compact('umkm'));
    }

    public function create()
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();

        return view('admin.umkm.create', compact('daftarRt'));
    }

    public function store(StoreUmkmRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['nama']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-umkm', 'public');
        }

        $item = Umkm::create($data);

        ActivityLog::log('create', $item, $item->nama, null, $item->only([
            'nama', 'kategori', 'nama_pemilik', 'alamat', 'rt',
        ]));

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function show(Umkm $umkm)
    {
        return view('admin.umkm.show', compact('umkm'));
    }

    public function edit(Umkm $umkm)
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();

        return view('admin.umkm.edit', compact('umkm', 'daftarRt'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:'.implode(',', Umkm::$kategoriList),
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'no_hp' => 'required|string|max:20',
            'jam_operasional' => 'nullable|string|max:100',
            'maps_link' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $old = $umkm->only([
            'nama', 'kategori', 'nama_pemilik', 'alamat', 'rt', 'no_hp', 'is_active',
        ]);

        if ($request->hasFile('foto')) {
            if ($umkm->foto) {
                Storage::disk('public')->delete($umkm->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-umkm', 'public');
        }

        if (isset($data['is_active'])) {
            $data['is_active'] = (bool) $request->input('is_active', 0);
        }

        $umkm->update($data);

        ActivityLog::log('update', $umkm, $umkm->nama, $old, $umkm->only(array_keys($data)));

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        $old = $umkm->only([
            'nama', 'kategori', 'nama_pemilik', 'alamat', 'rt',
        ]);

        if ($umkm->foto) {
            Storage::disk('public')->delete($umkm->foto);
        }

        ActivityLog::log('delete', $umkm, $umkm->nama, $old, null);

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }
}
