<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model {
    protected $fillable = ['pengirim_id', 'penerima_id', 'status'];
    public function sender() { return $this->belongsTo(User::class, 'pengirim_id'); }
    public function receiver() { return $this->belongsTo(User::class, 'penerima_id'); }
}