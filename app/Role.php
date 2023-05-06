<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permits()
    {
        return $this->belongsToMany(Permit::class, 'roles_permits');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
