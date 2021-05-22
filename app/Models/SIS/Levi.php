<?php

namespace App\Models\SIS;

use Illuminate\Database\Eloquent\Model;

class Levi extends Model
{
    protected $table = 'levi';
    protected $guarded = ['id'];

    public function Pelesen() {
        return $this->belongsTo('App\Models\SIS\Pelesen', 'pelesen_id');
    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
