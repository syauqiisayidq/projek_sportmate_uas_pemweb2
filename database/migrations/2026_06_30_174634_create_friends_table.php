<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('penerima_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak', 'Dibatalkan'])->default('Pending');
            $table->timestamps();
            $table->unique(['pengirim_id', 'penerima_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('friends'); }
};