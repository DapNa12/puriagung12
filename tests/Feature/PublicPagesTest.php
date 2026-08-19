<?php

namespace Tests\Feature;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Puri Agung Permai RW12');
    }

    public function test_pengumuman_page_is_accessible(): void
    {
        $response = $this->get('/pengumuman');
        $response->assertStatus(200);
    }

    public function test_kegiatan_page_is_accessible(): void
    {
        $response = $this->get('/kegiatan');
        $response->assertStatus(200);
        $response->assertSee('Kegiatan RW');
    }

    public function test_galeri_page_is_accessible(): void
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri Momen');
    }

    public function test_profil_page_is_accessible(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Profil');
        $response->assertSee('Letak Geografis');
    }

    public function test_statistik_page_is_accessible(): void
    {
        $response = $this->get('/statistik');
        $response->assertStatus(200);
        $response->assertSee('Statistik Kependudukan');
    }

    public function test_pengurus_rt_page_is_accessible(): void
    {
        $response = $this->get('/pengurus-rt');
        $response->assertStatus(200);
        $response->assertSee('Pengurus RT');
    }

    public function test_struktur_rw_page_is_accessible(): void
    {
        $response = $this->get('/struktur-rw');
        $response->assertStatus(200);
        $response->assertSee('Struktur RW');
    }

    public function test_administrasi_kependudukan_page_is_accessible(): void
    {
        $response = $this->get('/layanan/administrasi-kependudukan');
        $response->assertStatus(200);
        $response->assertSee('Administrasi Kependudukan');
    }

    public function test_keamanan_wilayah_page_is_accessible(): void
    {
        $response = $this->get('/layanan/keamanan-wilayah');
        $response->assertStatus(200);
        $response->assertSee('Keamanan Wilayah');
    }

    public function test_kebersihan_lingkungan_page_is_accessible(): void
    {
        $response = $this->get('/layanan/kebersihan-lingkungan');
        $response->assertStatus(200);
        $response->assertSee('Kebersihan Lingkungan');
    }

    public function test_nonexistent_page_returns_404(): void
    {
        $response = $this->get('/halaman-tidak-ada');
        $response->assertStatus(404);
    }

    public function test_home_page_has_seo_meta_tags(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('meta name="description"', false);
        $response->assertSee('property="og:title"', false);
        $response->assertSee('property="og:description"', false);
    }

    public function test_pengumuman_page_has_seo_meta_tags(): void
    {
        $response = $this->get('/pengumuman');
        $response->assertStatus(200);
        $response->assertSee('meta name="description"', false);
        $response->assertSee('property="og:title"', false);
    }

    public function test_profil_page_has_seo_meta_tags(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('meta name="description"', false);
        $response->assertSee('property="og:title"', false);
    }

    public function test_search_page_is_accessible(): void
    {
        $response = $this->get('/search');
        $response->assertStatus(200);
        $response->assertSee('Pencarian');
    }

    public function test_search_page_with_query(): void
    {
        $response = $this->get('/search?q=test');
        $response->assertStatus(200);
        $response->assertSee('test', false);
    }

    public function test_search_page_short_query(): void
    {
        $response = $this->get('/search?q=a');
        $response->assertStatus(200);
        $response->assertSee('minimal 2 karakter');
    }

    public function test_sitemap_returns_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('urlset', false);
    }

    public function test_accessibility_skip_to_content(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Langsung ke konten', false);
        $response->assertSee('id="main-content"', false);
    }

    public function test_breadcrumbs_on_pengumuman_show(): void
    {
        $user = User::factory()->create();

        $pengumuman = Pengumuman::create([
            'user_id' => $user->id,
            'judul' => 'Pengumuman Test Breadcrumb',
            'kategori' => 'pemberitahuan',
            'isi' => 'Isi pengumuman untuk test breadcrumb.',
            'status' => 'aktif',
        ]);

        $response = $this->get('/pengumuman/'.$pengumuman->id);
        $response->assertStatus(200);
        $response->assertSee('Breadcrumb', false);
    }
}
