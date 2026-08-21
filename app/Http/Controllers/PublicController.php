<?php

namespace App\Http\Controllers;

use App\Models\GaleriAlbum;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\StatistikRw;
use App\Models\StatistikRwDetail;
use App\Models\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('status', 'aktif')
            ->latest()
            ->take(5)
            ->get();

        $kegiatan = Kegiatan::where('status', 'akan_datang')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->take(5)
            ->get();

        $totalWarga = StatistikRwDetail::get()->sum('total');

        return view('public.home', compact('pengumuman', 'kegiatan', 'totalWarga'));
    }

    public function pengumuman(Request $request)
    {
        $query = Pengumuman::where('status', 'aktif');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                    ->orWhere('isi', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $pengumuman = $query->latest()->paginate(9)->withQueryString();
        $totalPengumuman = Pengumuman::where('status', 'aktif')->count();

        return view('public.pengumuman', compact('pengumuman', 'totalPengumuman'));
    }

    public function pengumumanShow(Pengumuman $pengumuman)
    {
        if ($pengumuman->status !== 'aktif') {
            abort(404);
        }
        $relatedPengumuman = Pengumuman::where('status', 'aktif')
            ->where('id', '!=', $pengumuman->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.pengumuman-show', compact('pengumuman', 'relatedPengumuman'));
    }

    public function kegiatan()
    {
        $kegiatan = Kegiatan::orderBy('tanggal', 'desc')->paginate(10);

        return view('public.kegiatan', compact('kegiatan'));
    }

    public function kegiatanShow(Kegiatan $kegiatan)
    {
        return view('public.kegiatan-show', compact('kegiatan'));
    }

    public function pengurusRt()
    {
        $pengurus = Pengurus::whereNotNull('rt')
            ->orderBy('rt')
            ->orderBy('id')
            ->get();

        $grouped = $pengurus->groupBy('rt')->sortKeys();

        $tahunMulai = $pengurus->filter(fn ($p) => $p->periode_mulai)->min(fn ($p) => Carbon::parse($p->periode_mulai)->format('Y'));
        $tahunSelesai = $pengurus->filter(fn ($p) => $p->periode_selesai)->max(fn ($p) => Carbon::parse($p->periode_selesai)->format('Y'));

        return view('public.pengurus-rt', compact('grouped', 'tahunMulai', 'tahunSelesai'));
    }

    public function profil()
    {
        return view('public.profil');
    }

    public function strukturRw()
    {
        $urutanPeran = ['Ketua RW', 'Wakil Ketua', 'Sekretaris', 'Bendahara'];

        $pengurusRw = Pengurus::whereNull('rt')
            ->whereNull('organisasi')
            ->orderBy('id')
            ->get()
            ->sortBy(fn ($p) => ($key = array_search($p->jabatan, $urutanPeran, true)) === false ? 99 : $key)
            ->values();

        $organisasi = Pengurus::whereNotNull('organisasi')
            ->orderBy('organisasi')
            ->orderBy('jabatan')
            ->get()
            ->groupBy('organisasi');

        $tahunMulai = $pengurusRw->filter(fn ($p) => $p->periode_mulai)->min(fn ($p) => Carbon::parse($p->periode_mulai)->format('Y'));
        $tahunSelesai = $pengurusRw->filter(fn ($p) => $p->periode_selesai)->max(fn ($p) => Carbon::parse($p->periode_selesai)->format('Y'));

        return view('public.struktur-rw', compact('pengurusRw', 'organisasi', 'tahunMulai', 'tahunSelesai'));
    }

    public function strukturOrganisasi()
    {
        $organisasi = Pengurus::whereNotNull('organisasi')
            ->orderBy('organisasi')
            ->orderBy('jabatan')
            ->get()
            ->groupBy('organisasi');

        return view('public.struktur-organisasi', compact('organisasi'));
    }

    public function statistik(Request $request)
    {
        $selectedRt = $request->get('rt');
        $rows = StatistikRwDetail::orderBy('rt')->get();

        $daftarRt = $rows->pluck('rt');

        $filtered = $rows;
        if ($selectedRt) {
            $filtered = $rows->where('rt', $selectedRt)->values();
        }

        $totalWarga = $filtered->sum(fn ($r) => $r->laki + $r->perempuan);
        $wargaLaki = $filtered->sum('laki');
        $wargaPerempuan = $filtered->sum('perempuan');

        $usiaBalita = $filtered->sum('balita');
        $usiaAnak = $filtered->sum('anak');
        $usiaRemaja = $filtered->sum('remaja');
        $usiaDewasa = $filtered->sum('dewasa');
        $usiaLansia = $filtered->sum('lansia');

        $statAgama = [
            'Islam' => $filtered->sum('islam'),
            'Kristen' => $filtered->sum('kristen'),
            'Katolik' => $filtered->sum('katolik'),
            'Budha' => $filtered->sum('budha'),
            'Hindu' => $filtered->sum('hindu'),
            'Lainnya' => $filtered->sum('lainnya'),
        ];

        $statPendidikan = [
            'Belum Sekolah' => $filtered->sum('belum_sekolah'),
            'SD' => $filtered->sum('sd'),
            'SMP' => $filtered->sum('smp'),
            'SMA' => $filtered->sum('sma'),
            'D1' => $filtered->sum('d1'),
            'D2' => $filtered->sum('d2'),
            'D3' => $filtered->sum('d3'),
            'S1' => $filtered->sum('s1'),
            'S2' => $filtered->sum('s2'),
            'S3' => $filtered->sum('s3'),
        ];

        $statGoldar = [
            'A' => $filtered->sum('goldar_a'),
            'B' => $filtered->sum('goldar_b'),
            'AB' => $filtered->sum('goldar_ab'),
            'O' => $filtered->sum('goldar_o'),
        ];

        $jumlahRumah = 0;
        if (Schema::hasTable('statistik_rw')) {
            $statistikRw = StatistikRw::first();
            $jumlahRumah = $statistikRw ? $statistikRw->jumlah_rumah_bangunan : 0;
        }

        $wargaPerRt = $rows->map(function ($row) {
            return (object) [
                'rt' => $row->rt,
                'laki' => $row->laki,
                'perempuan' => $row->perempuan,
                'total' => $row->total,
            ];
        });

        return view('public.statistik', compact(
            'totalWarga', 'wargaLaki', 'wargaPerempuan', 'wargaPerRt',
            'usiaBalita', 'usiaAnak', 'usiaRemaja', 'usiaDewasa', 'usiaLansia',
            'jumlahRumah', 'statAgama', 'statPendidikan', 'statGoldar',
            'daftarRt', 'selectedRt'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $pengumuman = collect();
        $kegiatan = collect();
        $albums = collect();
        $umkmResults = collect();

        if (strlen($query) >= 2) {
            $pengumuman = Pengumuman::where('status', 'aktif')
                ->where(function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                        ->orWhere('isi', 'like', "%{$query}%");
                })
                ->latest()
                ->take(5)
                ->get();

            $kegiatan = Kegiatan::where(function ($q) use ($query) {
                $q->where('nama_kegiatan', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%")
                    ->orWhere('tempat', 'like', "%{$query}%");
            })
                ->latest()
                ->take(5)
                ->get();

            $albums = GaleriAlbum::withCount('fotos')
                ->where(function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                        ->orWhere('deskripsi', 'like', "%{$query}%");
                })
                ->latest()
                ->take(5)
                ->get();

            $umkmResults = Umkm::where('is_active', true)
                ->where(function ($q) use ($query) {
                    $q->where('nama', 'like', "%{$query}%")
                        ->orWhere('deskripsi', 'like', "%{$query}%")
                        ->orWhere('nama_pemilik', 'like', "%{$query}%");
                })
                ->latest()
                ->take(5)
                ->get();
        }

        $totalResults = $pengumuman->count() + $kegiatan->count() + $albums->count() + $umkmResults->count();

        return view('public.search', compact('query', 'pengumuman', 'kegiatan', 'albums', 'umkmResults', 'totalResults'));
    }

    public function sitemap()
    {
        $pengumuman = Pengumuman::where('status', 'aktif')
            ->latest()
            ->get();

        $kegiatan = Kegiatan::orderBy('updated_at', 'desc')->get();

        $albums = GaleriAlbum::with('fotos')->orderBy('updated_at', 'desc')->get();
        $umkmList = Umkm::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        $staticUrls = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('profil'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('struktur-rw'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('pengurus-rt'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('pengumuman'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('kegiatan'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('galeri'), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('statistik'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('umkm'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('layanan.administrasi-kependudukan'), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => route('layanan.keamanan-wilayah'), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => route('layanan.kebersihan-lingkungan'), 'changefreq' => 'monthly', 'priority' => '0.5'],
        ];

        foreach ($staticUrls as $url) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e($url['loc']).'</loc>'."\n";
            $xml .= '    <changefreq>'.$url['changefreq'].'</changefreq>'."\n";
            $xml .= '    <priority>'.$url['priority'].'</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($pengumuman as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('pengumuman.show', $item)).'</loc>'."\n";
            $xml .= '    <lastmod>'.$item->updated_at->format('Y-m-d').'</lastmod>'."\n";
            $xml .= '    <changefreq>monthly</changefreq>'."\n";
            $xml .= '    <priority>0.6</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($kegiatan as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('kegiatan.show', $item)).'</loc>'."\n";
            $xml .= '    <lastmod>'.$item->updated_at->format('Y-m-d').'</lastmod>'."\n";
            $xml .= '    <changefreq>monthly</changefreq>'."\n";
            $xml .= '    <priority>0.6</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($albums as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('galeri.show', $item->id)).'</loc>'."\n";
            $xml .= '    <lastmod>'.$item->updated_at->format('Y-m-d').'</lastmod>'."\n";
            $xml .= '    <changefreq>monthly</changefreq>'."\n";
            $xml .= '    <priority>0.5</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($umkmList as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('umkm.show', $item->slug)).'</loc>'."\n";
            $xml .= '    <lastmod>'.$item->updated_at->format('Y-m-d').'</lastmod>'."\n";
            $xml .= '    <changefreq>monthly</changefreq>'."\n";
            $xml .= '    <priority>0.6</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function umkm(Request $request)
    {
        $query = Umkm::where('is_active', true);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$request->search.'%')
                    ->orWhere('nama_pemilik', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $umkm = $query->latest()->paginate(12)->withQueryString();
        $daftarKategori = Umkm::$kategoriList;

        return view('public.umkm', compact('umkm', 'daftarKategori'));
    }

    public function umkmShow(Umkm $umkm)
    {
        if (! $umkm->is_active) {
            abort(404);
        }

        return view('public.umkm-show', compact('umkm'));
    }

    public function administrasiKependudukan()
    {
        return view('public.administrasi-kependudukan');
    }

    public function galeri()
    {
        $albums = GaleriAlbum::with('fotos')
            ->withCount('fotos')
            ->latest()
            ->paginate(9);

        return view('public.galeri', compact('albums'));
    }

    public function galeriShow(GaleriAlbum $album)
    {
        $album->load('fotos');

        return view('public.galeri-show', compact('album'));
    }

    public function keamananWilayah()
    {
        return view('public.keamanan-wilayah');
    }

    public function kebersihanLingkungan()
    {
        return view('public.kebersihan-lingkungan');
    }
}
