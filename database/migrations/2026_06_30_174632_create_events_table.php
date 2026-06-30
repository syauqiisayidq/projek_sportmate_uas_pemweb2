<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sport_id')->constrained('sports')->onDelete('cascade');
            $table->string('nama_event');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->integer('biaya')->default(0);
            $table->integer('kuota');
            $table->enum('status', ['Upcoming', 'Ongoing', 'Completed', 'Canceled'])->default('Upcoming');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('events'); }
};