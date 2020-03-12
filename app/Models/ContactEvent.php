<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;

class ContactEvent extends Model
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
    
    protected $fillable = ['contact_id', 'mimetype', 'event_date', 'event_type', 'event_label'];
    protected $appends = ['age','created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Event'];

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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Event');
        });
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    Public function getEventDateAttribute()
    {
        return $this->data1;
    }
    Public function getEventTypeAttribute()
    {
        return $this->data2;
    }
    Public function getEventLabelAttribute()
    {
        return $this->data3;
    }

    //--------------------------------------------------------------------------
    Public function getAgeAttribute()
    {
        $birth = $this->data1;
        $dead = $this->data4;
        if (!empty($birth)) {
            $born = Carbon::createFromFormat('Y-m-d',$birth);
            if (empty($dead)) {
                $today = Carbon::now();
            } else {
                $today = Carbon::createFromFormat('Y-m-d',$dead); 
            }
            return $today->diff($born)->format('%y');
        } else {
            return ''; 
        }
    }

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
    public function setEventDateAttribute($value)
    {
        $this->attributes['data1'] = $value;
    }
    public function setEventTypeAttribute($value)
    {
        $this->attributes['data2'] = $value;
    }
    public function setEventLabelAttribute($value)
    {
        $this->data3 = $value;
    }

}
