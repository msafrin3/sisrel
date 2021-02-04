<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{

    protected $fillable = [
        'name', 'display_name', 'description'
    ];
    public $guarded = [];

    public function Users() {
        return $this->hasMany('App\Models\RoleUser', 'role_id');
    }

    public function Perms() {
        return $this->hasMany('App\Models\PermissionRole', 'role_id');
    }
}
