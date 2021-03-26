<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use DaLiSoft\Userstamps\Userstamps;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BlogTag extends Model
{
    use CrudTrait;
    use Userstamps;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'blog_tags';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    // protected $hidden = [];
    // protected $dates = [];
//    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $fillable = ['name', 'description','slug'];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function posts()
    {
        return $this->belongsToMany('App\Models\BlogPost', 'blog_post_has_tags');
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
/*    Public function getCreatedByUserAttribute()
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
*/
    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }
        return $this->name;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
