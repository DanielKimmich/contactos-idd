<?php

namespace App\Models;

use App\User;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\InheritsRelationsFromParentModel;
use Backpack\CRUD\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BackpackUser extends User
{
    use InheritsRelationsFromParentModel;
    use Notifiable;

    protected $table = 'users';

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
//Ya estan definidos las funciones roles() y Permissions ()


//Roles del Usuario (no hace falta, usar roles())
    public function RolesViaUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        );
    }

//Permissos del los Roles del Usuario
   public function PermissionsViaRoles()
    {
        return $this->getPermissionsViaRoles()->implode('name', ', ');
        //->pluck('name');
    }

}
