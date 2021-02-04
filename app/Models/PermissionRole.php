<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id', 'role_id'
    ];

    public function Permission() {
        return $this->belongsTo('App\Models\Permission', 'permission_id');
    }

    public function Role() {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
}
