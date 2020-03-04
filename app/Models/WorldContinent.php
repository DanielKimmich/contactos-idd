<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Khsing\World\Models\Continent as OriginalContinent;
use Wildside\Userstamps\Userstamps;

class WorldContinent extends OriginalContinent
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'world_continents';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'code'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    Public function getCreatedByUserAttribute()
    {
        if (! empty( $this->creator->name)){
            return $this->creator->name;
        } else {
            return '';
        }
    }

    Public function getUpdatedByUserAttribute()
    {
        if (! empty( $this->editor->name)){
            return $this->editor->name;
        } else {
            return '';
        }
    }

    Public function getDeletedByUserAttribute()
    {
        if (! empty( $this->destroyer->name)){
            return $this->destroyer->name;
        } else {
            return '';
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
