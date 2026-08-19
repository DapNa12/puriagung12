<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\GaleriAlbum;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = GaleriAlbum::query()->withCount('fotos');

        if ($search = $request->get('search')) {
            $query->where('judul', 'like', "%{$search}%");
        }

        $albums = $query->latest()->paginate(9)->withQueryString();

        return view('admin.galeri.index', compact('albums', 'search'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['user_id'] = Auth::id();

        $album = GaleriAlbum::create($data);

        $jumlah = $this->storeFotos($request, $album);

        ActivityLog::log('create', $album, $album->judul, null, $album->only([
            'judul', 'deskripsi', 'tanggal',
        ]) + ['jumlah_foto' => $jumlah]);

        return redirect()->route('admin.galeri.show', $album)->with('success', 'Album berhasil dibuat ('.$jumlah.' foto).');
    }

    public function show(GaleriAlbum $album)
    {
        $album->load(['fotos', 'user']);

        return view('admin.galeri.show', compact('album'));
    }

    public function edit(GaleriAlbum $album)
    {
        return view('admin.galeri.edit', compact('album'));
    }

    public function update(Request $request, GaleriAlbum $album)
    {
        $data = $this->validated($request);

        $old = $album->only(['judul', 'deskripsi', 'tanggal']);

        $album->update($data);

        $jumlah = $this->storeFotos($request, $album);

        ActivityLog::log('update', $album, $album->judul, $old, $album->only(['judul', 'deskripsi', 'tanggal']));

        return redirect()->route('admin.galeri.show', $album)->with('success', 'Album berhasil diperbarui'.($jumlah ? ' ('.$jumlah.' foto ditambahkan).' : '.'));
    }

    public function destroy(GaleriAlbum $album)
    {
        $old = $album->only(['judul', 'deskripsi', 'tanggal']);
        $name = $album->judul;

        foreach ($album->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }

        ActivityLog::log('delete', $album, $name, $old, null);

        $album->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Album berhasil dihapus.');
    }

    public function destroyFoto(GaleriAlbum $album, GaleriFoto $foto)
    {
        $name = $album->judul.' - '.($foto->judul ?? 'Foto #'.$foto->id);

        Storage::disk('public')->delete($foto->foto);

        ActivityLog::log('delete', $foto, $name, ['foto' => $foto->foto], null);

        $foto->delete();

        return redirect()->route('admin.galeri.show', $album)->with('success', 'Foto berhasil dihapus.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [], [
            'judul' => 'judul album',
            'fotos' => 'foto',
            'fotos.*' => 'foto',
        ]);
    }

    protected function storeFotos(Request $request, GaleriAlbum $album): int
    {
        if (! $request->hasFile('fotos')) {
            return 0;
        }

        $jumlah = 0;

        foreach ($request->file('fotos') as $file) {
            $foto = GaleriFoto::create([
                'galeri_album_id' => $album->id,
                'judul' => null,
                'foto' => $file->store('foto-galeri', 'public'),
            ]);

            ActivityLog::log('create', $foto, $album->judul.' - Foto #'.$foto->id, null, ['foto' => $foto->foto]);

            $jumlah++;
        }

        return $jumlah;
    }
}
