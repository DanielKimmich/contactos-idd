<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DaLiSoft\Userstamps\Userstamps;
//use Jlorente\Laravel\IdentityStamp\Database\Eloquent\IdentityStamps;

class ContactRelation extends Model
{
    use CrudTrait;
    use Userstamps;
    //use IdentityStamps;
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

    protected $attributes = ['mimetype' => 'Relation'];
    protected $appends = ['name', 'label'];

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
    // public function person()
    public function persons()
    {
        return $this->belongsTo('App\Models\ContactPerson', 'contact_id', 'id');
    }

    public function parentrelacions()
    {
        return $this->belongsTo('App\Models\ContactPerson', 'data1', 'id');
    }

    public function types()
    {
        return $this->belongsTo('App\Models\ContentType', 'data2', 'type');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->where('mimetype', 'Relation');
        });
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    Public function getNameAttribute()
    {
        return $this->parentrelacions->display_name ?? '';
    }
    Public function getLabelAttribute()
    {
        return $this->types->label ?? '';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
