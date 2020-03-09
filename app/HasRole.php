<?php

namespace App;


trait HasRole
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->role->contains('title' , $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
}
