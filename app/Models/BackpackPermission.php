<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\PermissionManager\app\Models\Permission as OriginalPermission;
use DaLiSoft\Userstamps\Userstamps;
use Illuminate\Support\Collection;

class BackpackPermission extends OriginalPermission
{
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function UsersViaRoles()
    {
 //       return $this->hasManyThrough(
 //           config('backpack.permissionmanager.models.user'), // Modelo destino
  //          config('permission.models.role') // Modelo intermedio
        //    'course' // Clave foránea en la tabla intermedia
        //   'class' // Clave foránea en la tabla de destino
        //    'courses_id' // Clave primaria en la tabla de origen
        //    'classes_id' // Clave primaria en la tabla intermedia
   //     );
    }

    public function getUsersViaRoles(): Collection
    {
        return $this->loadMissing('roles', 'roles.users')
            ->roles->flatMap(function ($role) {
                return $role->users;
            })->sort()->values();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
