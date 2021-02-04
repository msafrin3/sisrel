<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $guarded = ['id'];
    
    public function Role() {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
