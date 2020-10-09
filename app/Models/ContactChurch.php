<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use App\Models\ContentType;
//use App\Models\ContactRelation;

class ContactChurch extends Model
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = ['display_name', 'sex_id', 'civil_status', 'status',
                           'relation_gift', 'relation_talent', 'relation_ministry'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user',];
    
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
    public function gifts()
    {
        return $this->hasMany('App\Models\ContactGift','contact_id', 'id');
    }

    public function Talents()
    {
        return $this->hasMany('App\Models\ContactTalent','contact_id', 'id');
    }

    public function ministries()
    {
        return $this->hasMany('App\Models\ContactMinistry','contact_id', 'id');
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
    //--------------------------------------------------------------------------
    public function getRelationGiftAttribute() {
        $data = self::gifts()->get();
        return $data->toJson();
    }
    public function getRelationTalentAttribute() {
        $data = self::talents()->get();
        return $data->toJson();
    }    
    public function getRelationMinistryAttribute() {
        $data = self::ministries()->get();
        return $data->toJson();
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
