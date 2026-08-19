<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin RW',
            'email' => 'admin@rwdusun.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $ketuaRW = User::factory()->create([
            'name' => 'Ketua RW',
            'email' => 'ketuarw@rwdusun.id',
            'password' => bcrypt('password'),
            'role' => 'ketua_rw',
        ]);

        $sekretaris = User::factory()->create([
            'name' => 'Sekretaris RW',
            'email' => 'sekretaris@rwdusun.id',
            'password' => bcrypt('password'),
            'role' => 'sekretaris',
        ]);

        $wargaData = [
            ['user_id' => $ketuaRW->id, 'nik' => '1234567890123001', 'nama' => 'Ahmad Sulaiman', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1980-01-15', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Merdeka No.1', 'rt' => '001', 'rw' => '012', 'no_telepon' => '081234567891', 'pekerjaan' => 'Wiraswasta', 'status_perkawinan' => 'kawin'],
            ['user_id' => $sekretaris->id, 'nik' => '1234567890123002', 'nama' => 'Rudi Hermawan', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '1995-05-20', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Merdeka No.2', 'rt' => '001', 'rw' => '012', 'no_telepon' => '081234567892', 'pekerjaan' => 'Wiraswasta', 'status_perkawinan' => 'belum_kawin'],
            ['user_id' => $sekretaris->id, 'nik' => '1234567890123003', 'nama' => 'Siti Rahmawati', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1990-10-10', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Merdeka No.3', 'rt' => '002', 'rw' => '012', 'no_telepon' => '081234567893', 'pekerjaan' => 'Ibu Rumah Tangga', 'status_perkawinan' => 'kawin'],
            ['user_id' => $admin->id, 'nik' => '1234567890123004', 'nama' => 'Dewi Sartika', 'tempat_lahir' => 'Yogyakarta', 'tanggal_lahir' => '1982-03-25', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Merdeka No.4', 'rt' => '001', 'rw' => '012', 'no_telepon' => '081234567894', 'pekerjaan' => 'Guru', 'status_perkawinan' => 'kawin'],
            ['user_id' => $admin->id, 'nik' => '1234567890123005', 'nama' => 'Eko Prasetyo', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1975-12-01', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Merdeka No.5', 'rt' => '002', 'rw' => '012', 'no_telepon' => '081234567895', 'pekerjaan' => 'Petani', 'status_perkawinan' => 'kawin'],
            ['user_id' => $admin->id, 'nik' => '1234567890123006', 'nama' => 'Fatimah Azzahra', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1995-07-15', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Merdeka No.6', 'rt' => '003', 'rw' => '012', 'no_telepon' => '081234567896', 'pekerjaan' => 'Mahasiswa', 'status_perkawinan' => 'belum_kawin'],
        ];

        foreach ($wargaData as $data) {
            Warga::create($data);
        }

        Pengurus::create([
            'warga_id' => 1,
            'jabatan' => 'Ketua RW',
            'periode_mulai' => '2025-01-01',
            'periode_selesai' => '2027-12-31',
        ]);

        Pengumuman::create([
            'user_id' => $admin->id,
            'judul' => 'Selamat Datang di Website Puri Agung Permai RW12',
            'isi' => 'Website resmi Puri Agung Permai RW12 telah diluncurkan. Warga dapat mengakses informasi terbaru seputar kegiatan dan pengumuman melalui website ini.',
            'status' => 'aktif',
        ]);

        Pengumuman::create([
            'user_id' => $admin->id,
            'judul' => 'Jadwal Rapat Bulanan RW',
            'isi' => 'Rapat bulanan Puri Agung Permai RW12 akan dilaksanakan pada hari Minggu, 25 Juni 2026, pukul 19.00 WIB di Balai RW. Dihadiri oleh pengurus dan ketua RT.',
            'tgl_mulai' => '2026-06-25',
            'tgl_selesai' => '2026-06-25',
            'status' => 'aktif',
        ]);

        Kegiatan::create([
            'user_id' => $admin->id,
            'nama_kegiatan' => 'Kerja Bakti Lingkungan',
            'deskripsi' => 'Kegiatan kerja bakti membersihkan lingkungan Puri Agung Permai RW12. Diikuti oleh seluruh warga.',
            'tanggal' => '2026-07-10',
            'waktu' => '07:00:00',
            'tempat' => 'Lingkungan Puri Agung Permai',
            'status' => 'akan_datang',
        ]);

        Kegiatan::create([
            'user_id' => $admin->id,
            'nama_kegiatan' => 'Posyandu Balita',
            'deskripsi' => 'Pelayanan posyandu untuk balita di lingkungan Puri Agung Permai RW12. Pemeriksaan kesehatan dan imunisasi.',
            'tanggal' => '2026-06-15',
            'waktu' => '08:00:00',
            'tempat' => 'Posyandu Puri Agung Permai',
            'status' => 'selesai',
        ]);
    }
}
