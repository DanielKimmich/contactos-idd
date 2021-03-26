<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use DaLiSoft\Userstamps\Userstamps;

class Notification extends Model
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'notifications';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['title', 'body', 'color', 'sound', 'icon', 'actions', 'priority', 'visibility', 'expires_at'];
    // protected $hidden = [];
    protected $dates = ['expires_at'];
    protected $appends = [//'created_by_user', 'updated_by_user', 'deleted_by_user',
                            'class_color'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getTypeColor()
    {   
        return [
            'RED'       => 'Peligro', 
            'GREEN'     => 'Aceptación',
            'BLUE'      => 'Información',
            'YELLOW'    => 'Advertencia',
        ];
    }

    public static function getTypePriority()
    {   
        return [
            'MAX'       => 'Máxima', 
            'HIGH'      => 'Alta',
            'DEFAULT'   => 'Normal',
            'LOW'       => 'Baja',
            'MIN'       => 'Mínima',
        ];
    }

    public static function getTypeVisibility()
    {   
        return [
            'PUBLIC'     => 'Pública', 
            'PRIVATE'    => 'Privada',
            'SECRET'     => 'Secreta',
        ];
    }

    public function getClassColorAttribute()
    {   
        switch ($this->color) {
            case 'RED':
                return 'danger';
            case 'GREEN':
                return 'success';
            case 'BLUE':
                return 'primary';
            case 'YELLOW':
                return 'warning';
            default:
                return 'primary';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
/*    Public function getCreatedByUserAttribute()
    {
        return $this->creator->name ?? '';
    }
    Public function getUpdatedByUserAttribute()
    {
        return $this->editor->name ?? '';
    }
    Public function getDeletedByUserAttribute()
    {
        return $this->destroyer->name ?? '';
    }
*/
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
