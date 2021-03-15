<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class ContentType extends Model
{
    use CrudTrait;
    use Userstamps;
    use HasTranslations;
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
    protected $fillable = ['mimetype', 'type', 'label', 'parent_id', 'extras'];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'user'];
    public $translatable = ['label'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getMimeType()
    {   
        $types = self::where('depth', 1)
                        ->orderBy('type', 'ASC')->pluck('label', 'type');
        return $types->toArray();
    }

    public static function getTypeStatus()
    {   
        $types = self::where('mimetype','Status')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeSexes()
    {   
        $types = self::where('mimetype','Sex')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeDocuments()
    {   
        $types = self::where('mimetype','Document')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypePhones()
    {   
        $types = self::where('mimetype','Phone')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeEmails()
    {   
        $types = self::where('mimetype','Email')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeAddresses()
    {   
        $types = self::where('mimetype','Address')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeBloods()
    {   
        $types = self::where('mimetype','Blood')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeAllRelations()
    {   
        $types = self::where('depth', 3)->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeFamilyRelations()
    {   
        $types = self::where('mimetype','Relation')->where('depth', 2)->orderBy('lft', 'ASC')->pluck('label','type');
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
        $types = self::where('mimetype','Civil_Status')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeChurchs()
    {   
        $types = self::where('mimetype','Church')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeGifts()
    {   
        $types = self::where('mimetype','Gift')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeTalents()
    {   
        $types = self::where('mimetype','Talent')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
        return $types->toArray();
    }

    public static function getTypeMinistries()
    {   
        $types = self::where('mimetype','Ministry')->where('depth', '>', 1)
                        ->orderBy('lft', 'ASC')->pluck('label','type');
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
