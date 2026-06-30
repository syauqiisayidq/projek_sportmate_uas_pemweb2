<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            // Relasi ke User pemilik notifikasi
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kategori notifikasi
            $table->enum('tipe', ['Event', 'Pertemanan', 'Sistem']);
            
            // Isi pesan
            $table->string('pesan');
            
            // Status baca
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};