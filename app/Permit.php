<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permits');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permits');
    }
}
