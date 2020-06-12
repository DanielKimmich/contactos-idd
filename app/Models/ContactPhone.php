<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;
use App\Models\ContentType;

class ContactPhone extends Model
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
    protected $fillable = ['contact_id', 'mimetype', 'data1', 'data2', 'data3'];
    protected $appends = ['phone_type_data','created_by_user', 'updated_by_user', 'deleted_by_user']; 
    protected $attributes = ['mimetype' => 'Phone'];  

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
    public function types()
    {
        $id = ContentType::where('type','Phone')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'data2', 'type')->where('parent_id', $id);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Phone');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */   
    Public function getPhoneTypeDataAttribute()
    {
        return ($this->types->label ?? '') .': '.$this->data1;
    }

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
