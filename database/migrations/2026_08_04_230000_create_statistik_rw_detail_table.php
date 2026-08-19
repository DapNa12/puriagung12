<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_rw_detail', function (Blueprint $table) {
            $table->id();
            $table->string('rt', 3)->unique();
            $table->unsignedInteger('laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->unsignedInteger('balita')->default(0);
            $table->unsignedInteger('anak')->default(0);
            $table->unsignedInteger('remaja')->default(0);
            $table->unsignedInteger('dewasa')->default(0);
            $table->unsignedInteger('lansia')->default(0);
            $table->unsignedInteger('islam')->default(0);
            $table->unsignedInteger('kristen')->default(0);
            $table->unsignedInteger('katolik')->default(0);
            $table->unsignedInteger('budha')->default(0);
            $table->unsignedInteger('hindu')->default(0);
            $table->unsignedInteger('lainnya')->default(0);
            $table->unsignedInteger('belum_sekolah')->default(0);
            $table->unsignedInteger('sd')->default(0);
            $table->unsignedInteger('smp')->default(0);
            $table->unsignedInteger('sma')->default(0);
            $table->unsignedInteger('d1')->default(0);
            $table->unsignedInteger('d2')->default(0);
            $table->unsignedInteger('d3')->default(0);
            $table->unsignedInteger('s1')->default(0);
            $table->unsignedInteger('s2')->default(0);
            $table->unsignedInteger('s3')->default(0);
            $table->unsignedInteger('goldar_a')->default(0);
            $table->unsignedInteger('goldar_b')->default(0);
            $table->unsignedInteger('goldar_ab')->default(0);
            $table->unsignedInteger('goldar_o')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_rw_detail');
    }
};
