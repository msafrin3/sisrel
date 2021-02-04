<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_user';
    protected $guarded = ['id'];

    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Permission() {
        return $this->belongsTo('App\Models\Permission', 'permission_id');
    }
}
