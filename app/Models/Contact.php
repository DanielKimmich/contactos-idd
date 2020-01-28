<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorldCountry;

class Contact extends Model
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
    public function nationality()
    {
        return $this->belongsTo(WorldCountry::class, 'nationality_id');
    }

    public function name()
    {
        return $this->hasOne('App\Models\ContactData','contact_id', 'id')->where('mimetype', 'Name');
    }

    public function sex()
    {
        return $this->belongsTo('App\Models\ContentType', 'sexo', 'id')->where('mimetype', 'Sexo');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\ContactData','contact_id', 'id')->where('mimetype', 'Phone');
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
