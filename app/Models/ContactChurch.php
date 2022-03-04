<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use DaLiSoft\Userstamps\Userstamps;
use Carbon\Carbon;
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
                           'relation_step', 'relation_gift', 'relation_talent', 'relation_ministry'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['baptismday'];
    
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
    public function steps()
    {
        return $this->hasMany('App\Models\ContactStep','contact_id', 'id');
    }

    public function gifts()
    {
        return $this->hasMany('App\Models\ContactGift','contact_id', 'id');
    }

    public function talents()
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
    Public function getBaptismdayAttribute()
    {
        $baptism = $this->steps()->firstWhere('data2', 'BAPTISM')->data1 ?? '';
        if (!empty($baptism)) {
            return Carbon::createFromFormat('Y-m-d',$baptism);
        } else {
            return ''; 
        }
    }


    public function getRelationStepAttribute() {
        $data = self::steps()->get();
        return $data->toJson();
    }
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setRelationStepAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::steps()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1']) || !empty($entry['data3'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::steps()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::steps()->find($id)->delete();
        }    
    }   



    public function setRelationGiftAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::gifts()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::gifts()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::gifts()->find($id)->delete();
        }    
    }   


    public function setRelationTalentAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::talents()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::talents()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::talents()->find($id)->delete();
        }    
    }   

    public function setRelationMinistryAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::ministries()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::ministries()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::ministries()->find($id)->delete();
        }    
    }   


}
