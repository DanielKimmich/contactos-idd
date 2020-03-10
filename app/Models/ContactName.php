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
        'contact_id', 
        'mimetype', 
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

    protected $appends = [
        'name_display', 
        'name_first', 'name_middle', 'name_family', 
        'name_prefix', 'name_suffix',               
        'created_by_user', 'updated_by_user', 'deleted_by_user'];
    protected $attributes = ['mimetype' => 'Name'];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
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

    Public function getNameprefixAttribute()
    {
        return $this->data4;
    }
    Public function getNameSuffixAttribute()
    {
        return $this->data6;
    }

    /**
    * Set the
    *
    * @param  string  $value
    * @return void
    */
/*
Public function setmimetypeAttribute($value)
    {
        dd($value);
    //    $this->attributes['mimetype'] = strtoupper($value);
    }
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

    Public function setNameprefixAttribute($value)
    {
        $this->data4 = $value;
    }
    Public function setNameSuffixAttribute($value)
    {
        $this->data6 = $value;
    }

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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    Public function getCreatedByUserAttribute()
    {
        if (! empty( $this->creator->name)){
            return $this->creator->name;
        } else {
            return '';
        }
    }

    Public function getUpdatedByUserAttribute()
    {
        if (! empty( $this->editor->name)){
            return $this->editor->name;
        } else {
            return '';
        }
    }

    Public function getDeletedByUserAttribute()
    {
        if (! empty( $this->destroyer->name)){
            return $this->destroyer->name;
        } else {
            return '';
        }        
    }

    public function setData14Attribute($value)
    {
        $attribute_name = "data14";
        $disk = config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        $destination_path = "public/uploads/contacts/photos"; // path relative to the disk above

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
        }
    }


}
