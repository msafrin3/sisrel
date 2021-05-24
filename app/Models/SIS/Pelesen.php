<?php

namespace App\Models\SIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelesen extends Model
{
    use SoftDeletes;
    protected $table = 'pelesen';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

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
