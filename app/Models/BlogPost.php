<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BlogPost extends Model
{
    use CrudTrait;
    use Userstamps;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'blog_posts';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['posted_at'];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user', 'comments_count'];
    protected $fillable = ['title', 'description', 'body', 'featured_image', 'slug', 'category_id', 'author_id', 'posted_at', 'status'];

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

    public static function getTypeStatus()
    {
        return [
            'public'    => 'Todos',
            'limited'   => 'Limitado',
            'privated'  => 'Solo yo',
            'draft'     => 'Borrador',
        ];
    }

    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo('App\Models\BlogCategory'); //,'category_id', 'id'
    }

    public function contacts()
    {
        return $this->belongsTo('App\Models\ContactPerson','author_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\BlogTag', 'blog_post_has_tags', 'post_id', 'tag_id' );
   }

    public function comments()
    {
        return $this->hasmany('App\Models\BlogComment','post_id', 'id');
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

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }
        return $this->title;
    }

   public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
