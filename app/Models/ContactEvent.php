<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ContactEvent extends Model
{
    use CrudTrait;

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
/*
    protected $appends = [
        'event_date', 
        'event_type',
        'event_label',         
        ];
*/
    protected $attributes = [
        'mimetype' => 'Event',
        ];

    protected $fakeColumns = ['data4', 'data6'];
//    protected $translatable = ['extras','data6','data4'];
    protected $casts = [
        'data4' => 'array',
        'data6' => 'array',
        ];
/*
    protected $visible = [
        'contact_id',
        'mimetype',
        'event_date', 
        'event_type',
        'event_label',
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
*/
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    
    Public function getEventDateAttribute()
    {
        return $this->data7;
    }

    Public function getEventTypeAttribute()
    {
        return $this->data8;
    }

    Public function getEventLabelAttribute()
    {
        return $this->data3;
    }

    //--------------------------------------------------------------------------
    public function setEventDateAttribute($value)
    {
        $this->data1 = $value;
    }
    public function setEventTypeAttribute($value)
    {
        $this->data2 = $value;
    }
    public function setEventLabelAttribute($value)
    {
        $this->data3 = $value;
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
