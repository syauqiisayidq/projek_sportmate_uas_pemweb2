<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventParticipant extends Model
{
    use HasFactory;

    // Wajib: Menunjuk ke nama tabel yang benar di database
    protected $table = 'events_participants';

    // Wajib: Mengizinkan data disimpan ke database
    protected $fillable = ['user_id', 'event_id', 'status', 'joined_at'];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Event
    public function event() {
        return $this->belongsTo(Event::class);
    }
}