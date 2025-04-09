<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->enum('Kategori', ['Ringan', 'Sedang', 'Berat'])->default('Ringan');
            // $table->string('point', 255);
            $table->string('deskripsi', 255);
            $table->string('foto', 255);
            $table->string('staff');
            $table->string('tanggal');
            $table->string('periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_pelanggarans');
    }
};
