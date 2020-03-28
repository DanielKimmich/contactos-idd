<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;
use App\Models\WorldCountry;
use App\Models\ContentType;

class Contact extends Model
//class Contact extends Pivot
{
    use CrudTrait;
    use Userstamps;

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
        'sex_id', 
        'nationality_id', 
        'blood_type',
        'photo_id',
        'status', 
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user',
                'birthday', 'age',
                'phone_mobile', 'phone_home', 'email1', 'address1'];
    // protected $fakeColumns = ['status'];
    // protected $isColumnNullable = ['nationality_id'];
    //  protected $casts = ['status' => 'array', ];

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
    public function names()
    {
        return $this->hasOne('App\Models\ContactName','contact_id','id');
    }

    public function documents()
    {
        return $this->hasOne('App\Models\ContactDocument','contact_id', 'id')->where('data2', 'TYPE_DOC');
    }

    public function events()
    {
        return $this->hasOne('App\Models\ContactEvent','contact_id','id')->where('data2', 'TYPE_BIRTHDAY');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\ContactPhone','contact_id', 'id');
    }

    public function emails()
    {
        return $this->hasMany('App\Models\ContactEmail','contact_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\ContactAddress','contact_id', 'id');
    }
/*
    public function sex()
    {
      //  return $this->belongsTo('App\Models\ContentType', 'sexo', 'id')->where('mimetype', 'Sexo');
        $id = ContentType::where('type','Sex')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'sex_id', 'type')->where('parent_id', $id);
    }

    public function statuses()
    {
        $id = ContentType::where('type','Status')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'status', 'type')->where('parent_id', $id);
    }
*/
    public function nationality()
    {
        return $this->belongsTo('App\Models\WorldCountry', 'nationality_id', 'code_alpha3');
    }
   
    public function types()
    {
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
    Public function getBirthdayAttribute()
    {
        $birth = $this->events()->firstWhere('data2', 'TYPE_BIRTHDAY')->data1 ?? '';
        if (!empty($birth)) {
            return Carbon::createFromFormat('Y-m-d',$birth);
        } else {
            return ''; 
        }
    }

    Public function getAgeAttribute()
    {
        $birth = $this->events()->firstWhere('data2', 'TYPE_BIRTHDAY')->data1 ?? '';
        $dead = $this->events()->firstWhere('data2', 'TYPE_BIRTHDAY')->data4 ?? '';
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

    Public function getPhoneMobileAttribute()
    {
        return $this->phones()->firstWhere('data2', 'TYPE_MOBILE')->data1 ?? '';
    }
    
    Public function getPhoneHomeAttribute()
    {
        return $this->phones()->firstWhere('data2', 'TYPE_HOME')->data1 ?? '';
    }   

    Public function getEmail1Attribute()
    {
        return $this->emails()->first()->data1 ?? '';
    }

    Public function getAddress1Attribute()
    {
        return $this->addresses()->first()->data1 ?? '';
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

}
