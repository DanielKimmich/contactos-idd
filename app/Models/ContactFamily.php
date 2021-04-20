<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use DaLiSoft\Userstamps\Userstamps;
use App\Models\ContentType;
use App\Models\ContactRelation;
//use Jlorente\Laravel\IdentityStamp\Database\Eloquent\IdentityStamps;

class ContactFamily extends Model
{
    use CrudTrait;
    use Userstamps;
 //   use IdentityStamps; 
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['display_name', 'civil_status', 'status', 
        'relation_parent', 'relation_spouse', 'relation_children', 'relation_relative', 'relation_other'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['created_by_user', 'updated_by_user', 'deleted_by_user',];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
  
public function touch()
{
    if (! $this->timestamps) {
        return false;
    }

    $this->updateTimestamps();
    $this->Updating();

    return $this->save();
}

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function relations()
    {
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id');
    }

    public function parents()
    {
        $keys = array_keys(ContentType::getTypeRelationParents());
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id')
                        ->whereIn('data2', $keys);
    }

    public function spouses()
    {
        $keys = array_keys(ContentType::getTypeRelationSpouses());
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id')
                        ->whereIn('data2', $keys);
    }

    public function children()
    {
        $keys = array_keys(ContentType::getTypeRelationChildren());
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id')
                        ->whereIn('data2', $keys);
    }

    public function relatives()
    {
        $keys = array_keys(ContentType::getTypeRelationRelatives());
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id')
                        ->whereIn('data2', $keys);
    }

    public function others()
    {
        $keys = array_keys(ContentType::getTypeRelationOthers());
    //    dump($keys);
        return $this->hasMany('App\Models\ContactRelation','contact_id', 'id')
                        ->whereIn('data2', $keys);
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
       // return $this->getCreatedByColumn();
    }
    Public function getUpdatedByUserAttribute()
    {
       return $this->editor->name ?? '';
       // return $this->getUpdatedByColumn();
    }
    Public function getDeletedByUserAttribute()
    {
       return $this->destroyer->name ?? '';
       // return $this->getDeletedByColumn();
    }
    //--------------------------------------------------------------------------
    public function getRelationParentAttribute() {
        $data = self::parents()->get();
        return $data->toJson();
    }
    public function getRelationSpouseAttribute() {
        $data = self::spouses()->get();
        return $data->toJson();
    }    
    public function getRelationChildrenAttribute() {
        $data = self::children()->get();
        return $data->toJson();
    }    
    public function getRelationRelativeAttribute() {
        $data = self::relatives()->get();
        return $data->toJson();
    }    
    public function getRelationOtherAttribute() {
        $data = self::others()->get();
        return $data->toJson();
    }   

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setRelationParentAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::parents()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::parents()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::parents()->find($id)->delete();
        }    
        //Insertar registros relacion inversa
        $this->createRelation($value);
    }   

    public function setRelationSpouseAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::spouses()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::spouses()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::spouses()->find($id)->delete();
        }    
        //Insertar registros relacion inversa
        $this->createRelation($value);
    }   

    public function setRelationChildrenAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::children()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::children()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::children()->find($id)->delete();
        }    
        //Insertar registros relacion inversa
        $this->createRelation($value);
    }    

    public function setRelationRelativeAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::relatives()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::relatives()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::relatives()->find($id)->delete();
        }    
        //Insertar registros relacion inversa
        $this->createRelation($value);
    }    



    public function setRelationOtherAttribute($value) {
        $data = (json_decode($value, true)); //converts json into array
        $keys = self::others()->get()->modelKeys();
        //Insertar o actualizar registros en parent
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['id'];
                    unset($entry['id']);
                    if (($key = array_search($id, $keys)) !== false) 
                        unset($keys[$key]);  
                    self::others()->updateOrCreate(['id' => $id], $entry);
                }
            }
        }
        //Eliminar registros en parent
        if(!empty($keys)) {
            foreach ($keys as $id) 
                self::others()->find($id)->delete();
        }    
        //Insertar registros relacion inversa
        $this->createRelation($value);
    }   

    public function createRelation($value) {
        $data = (json_decode($value, true)); //converts json into array
        //dump($this->id);
        //dump($this->sex_id);
        //Insertar registros relacion inversa
        if(is_array($data)) {
            foreach ($data as $entry) {
                if (!empty($entry['data1'])) {
                    $id = (int) $entry['data1'];
                    $type =  $entry['data2'];
                    //dump($id);
                   // $types = ContentType::where('type', $type)->pluck('extras');

                    
                    //$relation = ContactRelation::where('contact_id', $id)->get()->modelKeys();
                    $relation = ContactRelation::where('contact_id', $id)
                                    ->where('data1', $this->id)
                                    ->get()->modelKeys();
                                   // ->pluck('data2','data1');
                    //dump($relation);
                    if(empty($relation)) {
                        $types = ContentType::where('type', $type)->first()->extras;
                        $arr_types = (json_decode($types, true)); //converts json into array
                        //dump($arr_types);
                        if(is_array($arr_types)) {
                          foreach ($arr_types as $reverse) {
                            if ($reverse['data1'] == $this->sex_id) {
                                //dump($reverse['data2']);
                                ContactRelation::create([
                                    'contact_id' => $id,
                                    'data1' => $this->id,
                                    'data2' => $reverse['data2'],
                                    'data3' => 'generado automaticamente',
                                ]);
                            }
                          }
                        }
                    }    
                }
            }
        }
    } 

}
