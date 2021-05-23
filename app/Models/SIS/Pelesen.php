<?php

namespace App\Models\SIS;

use Illuminate\Database\Eloquent\Model;

class Pelesen extends Model
{
    protected $table = 'pelesen';
    protected $guarded = ['id'];

    public function Levis() {
        return $this->hasMany('App\Models\SIS\Levi', 'pelesen_id');
    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Attachments() {
        return $this->hasMany('App\Models\SIS\PelesenAttachment', 'pelesen_id');
    }
}
