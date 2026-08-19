<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pengumumanQuery = Pengumuman::query()->with('user');
        $kegiatanQuery = Kegiatan::query()->with('user');

        if ($search) {
            $pengumumanQuery->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
            $kegiatanQuery->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $items = $pengumumanQuery->get()
            ->map(fn (Pengumuman $p) => [
                'tipe' => 'pengumuman',
                'id' => $p->id,
                'judul' => $p->judul,
                'konten' => $p->isi,
                'kategori' => $p->kategori,
                'status' => $p->status,
                'foto' => $p->foto,
                'user' => $p->user,
                'tanggal' => $p->tgl_mulai ?? $p->created_at,
            ])
            ->concat($kegiatanQuery->get()->map(fn (Kegiatan $k) => [
                'tipe' => 'kegiatan',
                'id' => $k->id,
                'judul' => $k->nama_kegiatan,
                'konten' => $k->deskripsi,
                'tanggal' => $k->tanggal,
                'waktu' => $k->waktu,
                'tempat' => $k->tempat,
                'status' => $k->status,
                'foto' => $k->foto,
                'user' => $k->user,
            ]))
            ->sortByDesc('tanggal')
            ->values();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $berita = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.berita.index', compact('berita', 'search'));
    }
}
