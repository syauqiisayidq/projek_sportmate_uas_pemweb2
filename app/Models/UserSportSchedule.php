<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserSportSchedule extends Model {
    protected $fillable = ['user_sport_id', 'hari', 'jam_mulai', 'jam_selesai'];
    public function userSport() { return $this->belongsTo(UserSport::class, 'user_sport_id'); }
}
