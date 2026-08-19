<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->string('agama', 30)->nullable()->after('pekerjaan');
            $table->string('pendidikan', 50)->nullable()->after('agama');
            $table->string('golongan_darah', 5)->nullable()->after('pendidikan');
            $table->string('no_rumah', 20)->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['agama', 'pendidikan', 'golongan_darah', 'no_rumah']);
        });
    }
};
