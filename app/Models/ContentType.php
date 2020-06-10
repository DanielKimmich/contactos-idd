<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ContentType extends Model
{
    use CrudTrait;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'content_types';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];

    // protected $hidden = [];
    // protected $dates = [];
    protected $fillable = ['mimetype', 'type', 'label', 'parent_id'];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'user'];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getTypeStatus()
    {   
        $id = self::where('type','Status')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeSexes()
    {   
        $id = self::where('type','Sex')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeDocuments()
    {   
        $id = self::where('type','Document')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypePhones()
    {   
        $id = self::where('type','Phone')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeEmails()
    {   
        $id = self::where('type','Email')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeAddresses()
    {   
        $id = self::where('type','Address')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeBloods()
    {   
        $id = self::where('type','Blood')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelations()
    {   
        $id = self::where('type','Relation')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelationParents()
    {   
        $id = self::where('type','TYPE_PARENT')->where('depth', 2)->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelationSpouses()
    {   
        $id = self::where('type','TYPE_SPOUSE')->where('depth', 2)->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelationChildren()
    {   
        $id = self::where('type','TYPE_CHILDREN')->where('depth', 2)->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelationRelatives()
    {   
        $id = self::where('type','TYPE_RELATIVE')->where('depth', 2)->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeRelationOthers()
    {   
        $id = self::where('type','TYPE_OTHERS')->where('depth', 2)->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }
            
    public static function getTypeCivilStatus()
    {   
        $id = self::where('type','Civil_Status')->where('depth', 1)->orWhereNull('depth')->first()->id;
        $types = self::where('parent_id', $id)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function parent()
    {
        return $this->belongsTo('App\Models\ContentType', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\ContentType', 'parent_id');
    }    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
                    ->orWhere('depth', null)
                    ->orderBy('lft', 'ASC');
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
