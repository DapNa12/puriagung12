<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengurusRequest;
use App\Models\ActivityLog;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengurus::query();
        if ($organisasi = $request->get('organisasi')) {
            $query->where('organisasi', $organisasi);
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('rt', 'like', "%{$search}%")
                    ->orWhere('organisasi', 'like', "%{$search}%");
            });
        }
        $pengurus = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function organisasi(Request $request)
    {
        $query = Pengurus::whereNotNull('organisasi');
        if ($organisasi = $request->get('filter')) {
            $query->where('organisasi', $organisasi);
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('organisasi', 'like', "%{$search}%");
            });
        }
        $pengurus = $query->orderBy('organisasi')->orderBy('jabatan')->paginate(10)->withQueryString();

        return view('admin.pengurus.organisasi', compact('pengurus'));
    }

    public function create()
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();

        return view('admin.pengurus.create', compact('daftarRt'));
    }

    public function store(StorePengurusRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus = Pengurus::create($data);

        $name = $pengurus->nama.' - '.$pengurus->jabatan;
        ActivityLog::log('create', $pengurus, $name, null, $pengurus->only([
            'nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai',
        ]));

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        return view('admin.pengurus.show', compact('pengurus'));
    }

    public function edit(Pengurus $pengurus)
    {
        $daftarRt = collect(range(1, 9))->map(fn ($n) => str_pad($n, 3, '0', STR_PAD_LEFT))->values();

        return view('admin.pengurus.edit', compact('pengurus', 'daftarRt'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'rt' => 'nullable|string|max:3',
            'organisasi' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai']);
        $oldName = $pengurus->nama.' - '.$pengurus->jabatan;

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus->update($data);
        $newName = $pengurus->nama.' - '.$pengurus->jabatan;

        ActivityLog::log('update', $pengurus, $newName, $old, $pengurus->only(array_keys($data)));

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        $old = $pengurus->only(['nama', 'rt', 'organisasi', 'jabatan', 'periode_mulai', 'periode_selesai']);
        $name = $pengurus->nama.' - '.$pengurus->jabatan;

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        ActivityLog::log('delete', $pengurus, $name, $old, null);

        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil dihapus.');
    }
}
