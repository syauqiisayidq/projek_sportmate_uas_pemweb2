<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['user_id', 'sport_id', 'nama_event', 'tanggal', 'lokasi', 'kuota', 'status'];
    public function creator() { return $this->belongsTo(User::class, 'user_id'); }
    public function participants() { return $this->belongsToMany(User::class, 'events_participants'); }
}
