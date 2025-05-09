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
        //
        Schema::table('catatan_pelanggarans', function (Blueprint $table) {
            $table->string('foto')->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('nohp')->nullable()->change();
            $table->string('address')->nullable()->change();
            // $table->string('foto')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->string('nohp')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            // $table->string('foto')->nullable(false)->change();
        });
        //
        Schema::table('catatan_pelanggarans', function (Blueprint $table) {
            $table->string('foto')->nullable(false)->change(); // balik ke NOT NULL
        });
    }
};
