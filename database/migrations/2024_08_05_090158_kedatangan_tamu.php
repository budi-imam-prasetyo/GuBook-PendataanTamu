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
        Schema::create('kedatangan_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('NIP');
            $table->foreign('NIP')->references('NIP')->on('pegawais')->onDelete('cascade');
            $table->foreignId('id_tamu')->constrained('tamu')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->text('qr_code');
            $table->string('instansi');
            $table->string('tujuan');
            $table->timestamp('waktu_perjanjian');
            $table->string('foto')->nullable();
            $table->timestamp('waktu_kedatangan')->nullable();
            $table->timestamps();
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
