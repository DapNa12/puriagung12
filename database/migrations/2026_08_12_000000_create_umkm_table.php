<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('nama_pemilik');
            $table->string('alamat');
            $table->string('rt');
            $table->string('no_hp');
            $table->string('jam_operasional')->nullable();
            $table->string('maps_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
