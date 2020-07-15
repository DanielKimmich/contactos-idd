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
    protected $touches = ['persons'];    
    protected $fillable = ['contact_id', 'mimetype', 'event_birth', 'event_type', 'event_label', 'event_dead'];
    protected $appends = ['display_name', 'age', 'birthday', 'created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Event'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    Public function getAgeContact()
    {
        $age = '';
        $born = $this->data1;
        $dead = $this->data4;
        if (!empty($born)) {
            $birth = Carbon::createFromFormat('Y-m-d',$born);
            if (empty($dead)) {
                $today = Carbon::today();
            } else {
                $today = Carbon::createFromFormat('Y-m-d',$dead); 
            }
            $age = $today->diff($birth)->format('%y');
        } 
        return $age;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    // public function contact()
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
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Event');
        });
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    Public function getEventBirthAttribute()
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
    Public function getEventDeadAttribute()
    {
        return $this->data4;
    }
    //--------------------------------------------------------------------------
    Public function getBirthdayAttribute()
    {
        $options = [];
        $born = $this->data1;
        $dead = $this->data4;
        if (!empty($born) and empty($dead)) {
            $birth = Carbon::createFromFormat('Y-m-d',$born);
            $options[] = $birth->format('n');
            $toDay = $birth->format("d");
            $toMonth = $birth->format("m");
            $toYear = Carbon::today()->format("Y");
            $today = Carbon::today()->format('Ymd');
            $yesterday = Carbon::yesterday()->format('Ymd');
            $date = Carbon::createFromDate($toYear, $toMonth, $toDay)->format('Ymd');
            $today7 = Carbon::today()->addDays(7)->format('Ymd');
            if ($date == $today) {
                $options[] = '0';
            } 
            if ($date == $yesterday) {
                $options[] = '-1';
            } 
            if (($date > $today) and ($date <= $today7)) {
                $options[] = '+7';
            } 
        }
        return $options;
    }

//User::whereNotNull('birth_date') ->where('birth_date', '<=', $endDate) ->whereIn(DB::raw("to_char(birth_date, 'MMDD')"), Carbon::range($startDate, $endDate)->map(function ($date) { return $date->format('md'); }))->get(); 

    Public function getAgeAttribute()
    {
        $age = '';
        $born = $this->data1;
        $dead = $this->data4;
        if (!empty($born)) {
            $birth = Carbon::createFromFormat('Y-m-d',$born)->setTime(00,00,00);
            if (empty($dead)) {
                $today = Carbon::today(); //->setTime(00,00,00)
            } else {
                $today = Carbon::createFromFormat('Y-m-d',$dead)->setTime(00,00,00); 
            }
            $age = $today->diff($birth)->format('%y');
        } 
        return $age;
    }

    Public function getDisplayNameAttribute()
    {
        return $this->persons->display_name ?? '';
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
    public function setEventBirthAttribute($value)
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
    public function setEventDeadAttribute($value)
    {
        $this->attributes['data4'] = $value;
    }

}
