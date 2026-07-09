<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sport_id', 'nama_event', 'tanggal', 'jam', 'jam_selesai', 'lokasi', 'kuota', 'deskripsi', 'foto', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function joinedUsers()
    {
        return $this->belongsToMany(User::class, 'event_participants')->withPivot('status', 'joined_at')->withTimestamps();
    }

    public function getJumlahPesertaAttribute(): int
    {
        return $this->participants()->count();
    }

    public function isFull(): bool
    {
        return $this->jumlah_peserta >= $this->kuota;
    }
}
