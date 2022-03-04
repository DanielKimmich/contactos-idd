<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DaLiSoft\Userstamps\Userstamps;
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
    protected $touches = ['persons'];
    protected $fillable = ['contact_id', 'mimetype', 'data1', 'data2', 'data3', 'data4', 'data5'];
    protected $appends = ['label','phone_type_data']; 
    protected $attributes = ['mimetype' => 'Phone'];  

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
 
    public function touchOwners()  // touchOwners()
    {
        parent::touchOwners();    
        foreach ($this->touches as $relation) {
            $this->$relation->touch_user();
        }
    } 

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */    
    public function types()
    {
        $type_id = ContentType::where('type','Phone')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'data2', 'type')->where('parent_id', $type_id);
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
        static::addGlobalScope('phone', function (Builder $builder) {
            $builder->where('mimetype', 'Phone');
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

    Public function getPhoneTypeDataAttribute()
    {
        if (empty($this->types->label))
            return $this->data1;
        else
            return $this->types->label .': '.$this->data1;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
