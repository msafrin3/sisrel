<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $table = 'meta_data';
    protected $guarded = ['id'];

    public function Meta() {
        return $this->belongsTo('App\Models\Meta', 'meta_id');
    }
}
