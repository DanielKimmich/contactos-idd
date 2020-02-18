<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\WorldCountry;
use App\Models\ContentType;

class Contact extends Model
//class Contact extends Pivot
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = [
        'display_name', 
        'sexo', 
        'nationality_id', 
        'blood_type',
        'photo_id',
        'status', 
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['birthday'];
   // protected $fakeColumns = ['status'];
    // protected $isColumnNullable = ['nationality_id'];

//json_decode() expects parameter 1 to be string, array given

  //  protected $casts = ['status' => 'array', ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    Public function getBirthdayAttribute()
    {
        return $this->events()->first()->data7;
       // return $this->data7;
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


    public function names()
    {
        return $this->hasOne('App\Models\ContactName','contact_id','id')->where('mimetype', 'Name');
    }

    public function documents()
    {
        return $this->hasOne('App\Models\ContactDocument','contact_id', 'id')->where('mimetype', 'Document');
    }

    public function events()
    {
       return $this->hasOne('App\Models\ContactEvent','contact_id','id')->where('mimetype', 'Event');
    }

    public function phones()
    {
     //   return $this->hasMany('App\Models\ContactData','contact_id', 'id')->where('mimetype', 'Phone');
         return $this->hasMany('App\Models\ContactPhone','contact_id', 'id')->where('mimetype', 'Phone');
    }

    public function emails()
    {
         return $this->hasMany('App\Models\ContactEmail','contact_id', 'id')->where('mimetype', 'Email');
    }

    public function addresses()
    {
         return $this->hasMany('App\Models\ContactAddress','contact_id', 'id')->where('mimetype', 'Address');
    }

    public function sex()
    {
        return $this->belongsTo('App\Models\ContentType', 'sexo', 'id')->where('mimetype', 'Sexo');
    }

    public function nationality()
    {
        return $this->belongsTo(WorldCountry::class, 'nationality_id');
    }
   
    public function types()
    {
      //  return $this->belongsTo('App\Models\ContentType', 'sexo', 'id')->where('mimetype', 'Sexo');
        return ContentType::all();
        //->sortBy('label')->pluck('label', 'id');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
