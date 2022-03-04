<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DaLiSoft\Userstamps\Userstamps;
use App\Models\ContentType;

class ContactEmail extends Model
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
    protected $fillable = ['contact_id', 'mimetype', 'data1', 'data2', 'data3','data4'];
    protected $appends = ['label', 'email_type_data']; 
    //'created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Email'];

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
        $id = ContentType::where('type','Email')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'data2', 'type')->where('parent_id', $id);
    }

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
        static::addGlobalScope('email', function (Builder $builder) {
            $builder->where('mimetype', 'Email');
        });
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
   */ 
    Public function getLabelAttribute()
    {
        return $this->types->label ?? '';
    }

    Public function getEmailTypeDataAttribute()
    {
        if (empty($this->types->label))
            return $this->data1;
        else
            return $this->types->label .': '.$this->data1;
    }
/*
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
*/    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
