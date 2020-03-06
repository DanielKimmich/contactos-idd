<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthDevice extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'devices';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['operating_system', 'web_browser', 'device'];
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
    Public function getOperatingSystemAttribute()
    {
        return $this->platform .' ('. strstr($this->platform_version, '.', true) .')';

    }

    Public function getWebBrowserAttribute()
    {
        return $this->browser .' ('. strstr($this->browser_version, '.', true) .')';
    }

    Public function getDeviceAttribute()
    {
        if ($this->is_desktop) {
        	return 'Desktop';
        } elseif ($this->is_mobile) {
        	return 'Mobile';
        } else {
        	return '';
        }
    }
}
