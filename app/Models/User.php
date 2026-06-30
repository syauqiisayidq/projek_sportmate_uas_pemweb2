<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use HasFactory;
    protected $fillable = ['nama', 'email', 'password', 'kota', 'role'];

    public function userSports() { return $this->hasMany(UserSport::class); }
    public function createdEvents() { return $this->hasMany(Event::class, 'user_id'); }
    public function participatingEvents() { return $this->belongsToMany(Event::class, 'events_participants'); }
    public function sentFriendRequests() { return $this->hasMany(Friend::class, 'pengirim_id'); }
    public function receivedFriendRequests() { return $this->hasMany(Friend::class, 'penerima_id'); }
}