<?php

namespace App\Models\SIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PelesenAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'pelesen_attachment';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function Pelesen() {
        return $this->belongsTo('App\Models\SIS\Pelesen', 'pelesen_id');
    }
}
