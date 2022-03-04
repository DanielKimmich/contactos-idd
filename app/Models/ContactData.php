<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DaLiSoft\Userstamps\Userstamps;
use Illuminate\Support\Str;

class ContactData extends Model
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
    protected $fillable = [
        'contact_id', 'mimetype', 
        'data1', 'data2', 'data3', 'data4', 'data5', 
        'data6', 'data7', 'data8', 'data9', 'data10', 
        'data11', 'data12', 'data13', 'data14', 'data15',
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

 //   protected $fakeColumns = ['data4', 'data6'];
//    protected $translatable = ['extras','data6','data4'];
//    protected $casts = [
 //       'data4' => 'array',
 //       'data6' => 'array',
 //       ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function person()
    {
        return $this->belongsTo('App\Models\ContactPerson', 'contact_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\ContactPerson', 'data1', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
/*
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Address');
        });
    }
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
