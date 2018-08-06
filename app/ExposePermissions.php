<?php

namespace App;


use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

trait ExposePermissions
{
    /**
     * Get all user permissions.
     *
     * @return bool
     */
    public function getAllPermissionsAttribute()
    {
        return $this->getAllPermissions();
    }

    /**
     * Get all user permissions in a flat array.
     *
     * @return array
     */
    public function getCanAttribute()
    {
        $permissions = [];
        if(Auth::check()){
            foreach (Permission::all() as $permission) {
                if (Auth::user()->can($permission->name)) {
                    $permissions[$permission->name] = true;
                } else {
                    $permissions[$permission->name] = false;
                }
            }
            return $permissions;
        }

        return $permissions;
    }

}
