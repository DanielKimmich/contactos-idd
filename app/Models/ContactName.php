<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class ContactName extends Model
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
        'name_display', 
        'name_first', 'name_middle', 'name_family', 
        'name_prefix', 'name_suffix', 'data14',         
        ];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Name'];
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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {   parent::boot();
        static::addGlobalScope('event', function (Builder $builder) {
            $builder->where('mimetype', 'Name');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    Public function getNameDisplayAttribute()
    {
        return $this->data1;
    }
    Public function getNameFirstAttribute()
    {
        return $this->data2;
    }
    Public function getNameMiddleAttribute()
    {
        return $this->data5;
    }
    Public function getNameFamilyAttribute()
    {
        return $this->data3;
    }

    Public function getNamePrefixAttribute()
    {
        return $this->data4;
    }
    Public function getNameSuffixAttribute()
    {
        return $this->data6;
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
    Public function setNameDisplayAttribute($value)
    {
       $this->data1 = $value;
    }
    Public function setNameFirstAttribute($value)
    {
        $this->data2 = $value;
    }
    Public function setNameMiddleAttribute($value)
    {
        $this->data5 = $value;
    }
    Public function setNameFamilyAttribute($value)
    {
        $this->data3 = $value;
    }

    Public function setNamePrefixAttribute($value)
    {
        $this->data4 = $value;
    }
    Public function setNameSuffixAttribute($value)
    {
        $this->data6 = $value;
    }

    //--------------------------------------------------------------------------
    public function setData14Attribute($value)
    {
        $attribute_name = "data14";
        //$disk = config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        //$destination_path = "public/uploads/contacts/photos"; // path relative to the disk
        $disk = 'dropbox'; 
        $destination_path = 'contacts/photos'; // path relative to the disk
        
        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // 1. Generate a filename.
            //$filename = md5($value.time()).'.jpg';
            $filename = str_replace(' ', '',$this->attributes['data1']) .'(' .$this->attributes['contact_id'] .')' .'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it from the root folder
        // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
           // $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }

}
