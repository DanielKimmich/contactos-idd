<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Khsing\World\Models\Continent; //as OriginalContinent;
use DaLiSoft\Userstamps\Userstamps;

class WorldContinent extends Continent
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
//    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];

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
    public function countries()
    {
        return $this->hasMany('App\Models\WorldCountry','continent_id', 'id');
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
