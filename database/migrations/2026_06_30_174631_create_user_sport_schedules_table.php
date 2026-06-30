<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_sport_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_sport_id')->constrained('user_sports')->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();
            $table->unique(['user_sport_id', 'hari']);
        });
    }
    public function down(): void { Schema::dropIfExists('user_sport_schedules'); }
};