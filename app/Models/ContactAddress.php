<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DaLiSoft\Userstamps\Userstamps;
use App\Models\Country;
use App\Models\ContentType;

class ContactAddress extends Model
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
    protected $fillable = [
        'contact_id', 'mimetype', 
        'data1', 'data2', 'data3', 'data4', 'data5', 
        'data6', 'data7', 'data8', 'data9', 'data10', 
        'data11', 'data12', 'data13', 'data14', 'data15'
    ];

    protected $attributes = ['mimetype' => 'Address',  ];
    protected $appends = ['label', 'address_type_data']; 

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
        $id = ContentType::where('type','Address')->where('depth', 1)->orWhereNull('depth')->first()->id;
        return $this->belongsTo('App\Models\ContentType', 'data2', 'type')->where('parent_id', $id);
    }
 
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'data10', 'id');
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
        static::addGlobalScope('address', function (Builder $builder) {
            $builder->where('mimetype', 'Address');
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

    Public function getAddressTypeDataAttribute()
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
