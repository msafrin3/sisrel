<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';
    protected $guarded = ['id'];

    public function MetaData() {
        return $this->hasMany('App\Models\MetaData', 'meta_id');
    }
}
