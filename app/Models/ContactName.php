<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;

class ContactName extends Model
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
    protected $fillable = [
        'contact_id', 
        'mimetype', 
        'data1', 
        'data2', 
        'data3',
        'data4', 
        'data5', 
        'data6',
        'data7', 
        'data8', 
        'data9',
        'data10', 
        'data11', 
        'data12',
        'data13',
        'data14', 
        'data15',
        ];

    protected $appends = [
        'name_mimetype', 'name_display', 
        'name_first', 'name_middle', 'name_family', 
        'name_prefix', 'name_suffix',               
        'created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Name'];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    Public function getNameMimetypeAttribute()
    {
        return $this->mimetype;
    }

    Public function getNameDisplayAttribute()
    {
        return $this->data1;
    }

    Public function getNameFirstAttribute()
    {
        return $this->data2;
    }

    Public function getNameMiddleAttribute()
    {
        return $this->data5;
    }

    Public function getNameFamilyAttribute()
    {
        return $this->data3;
    }

    Public function getNameprefixAttribute()
    {
        return $this->data4;
    }
    Public function getNameSuffixAttribute()
    {
        return $this->data6;
    }

    /**
    * Set the
    *
    * @param  string  $value
    * @return void
    */
/*
Public function setmimetypeAttribute($value)
    {
        dd($value);
    //    $this->attributes['mimetype'] = strtoupper($value);
    }
*/
    Public function setNameMimetypeAttribute($value)
    {
       $this->mimetype = $value;
    }

    Public function setNameDisplayAttribute($value)
    {
       $this->data1 = $value;
    }

    Public function setNameFirstAttribute($value)
    {
        $this->data2 = $value;
    }
    Public function setNameMiddleAttribute($value)
    {
        $this->data5 = $value;
    }

    Public function setNameFamilyAttribute($value)
    {
        $this->data3 = $value;
    }

    Public function setNameprefixAttribute($value)
    {
        $this->data4 = $value;
    }
    Public function setNameSuffixAttribute($value)
    {
        $this->data6 = $value;
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
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Name');
        });
    }

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

}
