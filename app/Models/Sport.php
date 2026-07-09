<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['nama_sport', 'icon'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_sports')->withPivot('jadwal')->withTimestamps();
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
