<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DaLiSoft\Userstamps\Userstamps;

class ContentAlias extends Model
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'content_alias';
    public $timestamps = true;
    protected $fillable = ['mimetype', 'alias',	'data_column'];
//    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];

	 /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	/*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
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
