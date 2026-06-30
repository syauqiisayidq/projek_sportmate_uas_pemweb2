<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    use HasFactory;

    // Wajib: Agar bisa input data sport baru
    protected $fillable = ['nama_sport'];

    // Relasi (Opsional tapi disarankan)
    public function users() {
        return $this->belongsToMany(User::class, 'user_sports');
    }
}