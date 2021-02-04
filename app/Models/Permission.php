<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = ['id'];

    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function Roles() {
        return $this->hasMany('App\Models\PermissionRole', 'permission_id');
    }

    public function Users() {
        return $this->hasMany('App\Models\PermissionUser', 'permission_id');
    }
}
