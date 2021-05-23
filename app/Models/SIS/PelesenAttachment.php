<?php

namespace App\Models\SIS;

use Illuminate\Database\Eloquent\Model;

class PelesenAttachment extends Model
{
    protected $table = 'pelesen_attachment';
    protected $guarded = ['id'];

    public function Pelesen() {
        return $this->belongsTo('App\Models\SIS\Pelesen', 'pelesen_id');
    }
}
