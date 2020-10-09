<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;
use App\Models\ContentType;

class ContactTalent extends Model
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
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user']; 
    protected $attributes = ['mimetype' => 'Talent'];  

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function types()
    {
        $type_id = ContentType::where('type','Talent')->where('depth', 1)->orWhereNull('depth')->first()->id;
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
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Talent');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */   
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
