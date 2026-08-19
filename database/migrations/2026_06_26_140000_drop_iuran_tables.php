<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        if (Schema::hasTable('pemasukan')) {
            Schema::table('pemasukan', function (Blueprint $table) {
                $table->dropForeign(['iuran_id']);
                $table->dropColumn('iuran_id');
            });
        }

        Schema::dropIfExists('iuran');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        Schema::create('iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->string('jenis_iuran');
            $table->decimal('jumlah', 12, 2);
            $table->date('tanggal_bayar')->nullable();
            $table->string('bulan');
            $table->string('tahun');
            $table->enum('status', ['lunas', 'belum'])->default('belum');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        if (Schema::hasTable('pemasukan')) {
            Schema::table('pemasukan', function (Blueprint $table) {
                $table->foreignId('iuran_id')->nullable()->constrained('iuran')->nullOnDelete();
            });
        }
    }
};
