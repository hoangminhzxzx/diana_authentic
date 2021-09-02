<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function Users() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
