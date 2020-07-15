<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;

class ContactBlood extends Model
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'contact_data';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $touches = ['persons'];  
    protected $fillable = ['contact_id', 'mimetype', 'data1', 'data2', 'data3'];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Blood'];

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
    public function persons()
    {
        return $this->belongsTo('App\Models\ContactPerson', 'contact_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('blood', function (Builder $builder) {
            $builder->where('mimetype', 'Blood');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    //-------------------------------------------------------------------------- 
    Public function getCreatedByUserAttribute()
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

   /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
