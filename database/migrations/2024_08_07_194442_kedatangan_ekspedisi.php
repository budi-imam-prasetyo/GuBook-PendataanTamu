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
        Schema::create('kedatangan_ekspedisi', function (Blueprint $table) {
            $table->string('id_kedatanganEkspedisi')->primary();
            $table->string('id_ekspedisi');
            $table->foreign('id_ekspedisi')->references('id_ekspedisi')->on('ekspedisi')->onDelete('cascade');
            $table->string('NIP');
            $table->foreign('NIP')->references('NIP')->on('pegawais')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('foto');
            $table->timestamp('waktu_kedatangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
