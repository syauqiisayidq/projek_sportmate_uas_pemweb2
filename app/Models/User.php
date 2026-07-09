<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 'tanggal_lahir', 'gender', 'kota', 'foto', 'bio', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    public function getUmurAttribute(): ?int
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    public function getFotoUrlAttribute()
    {
        // Jika kolom 'foto' di database ada isinya, ambil dari folder storage
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }

        // JIKA KOSONG: Berikan gambar avatar default otomatis berdasarkan nama user!
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=random&color=fff';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'user_sports')->withPivot('jadwal')->withTimestamps();
    }

    public function userSports()
    {
        return $this->hasMany(UserSport::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function eventParticipations()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_participants')->withPivot('status', 'joined_at')->withTimestamps();
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friend::class, 'pengirim_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(Friend::class, 'penerima_id');
    }

    public function friends()
    {
        $sent = Friend::where('pengirim_id', $this->id)->where('status', 'diterima')->pluck('penerima_id');
        $received = Friend::where('penerima_id', $this->id)->where('status', 'diterima')->pluck('pengirim_id');

        return User::whereIn('id', $sent->merge($received))->get();
    }

    public function friendStatusWith(User $other): ?string
    {
        $friend = Friend::where(function ($q) use ($other) {
            $q->where('pengirim_id', $this->id)->where('penerima_id', $other->id);
        })->orWhere(function ($q) use ($other) {
            $q->where('pengirim_id', $other->id)->where('penerima_id', $this->id);
        })->first();

        return $friend?->status;
    }
}
