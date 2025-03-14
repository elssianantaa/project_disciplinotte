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
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('foto_bukti');
            $table->string('tanggal');
            $table->string('keterangan');
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
