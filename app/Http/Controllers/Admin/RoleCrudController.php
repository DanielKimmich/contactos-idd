<?php

//namespace Backpack\PermissionManager\app\Http\Controllers;
namespace App\Http\Controllers\Admin;
//use Backpack\PermissionManager\app\Http\Controllers\RoleCrudController as OriginalRoleCrudController;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController as OriginalRoleCrudController;
use Backpack\PermissionManager\app\Http\Requests\RoleStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\RoleUpdateCrudRequest as UpdateRequest;

// VALIDATION

class RoleCrudController extends OriginalRoleCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;


    public function setup()
    {
        $this->role_model = $role_model = config('backpack.permissionmanager.models.role');
        $this->permission_model = $permission_model = config('backpack.permissionmanager.models.permission');

        $this->crud->setModel($role_model);
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.role'), trans('backpack::permissionmanager.roles'));
        $this->crud->setRoute(backpack_url('role'));

        $this->setAccessOperation('authrole');
    }

    public function setupListOperation()
    {
        $this->setupAvancedOperation();
    // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label'     => ucfirst(trans('backpack::permissionmanager.permission_plural')),
            'type'      => 'select_multiple',
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'priority' => 4,            
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => $this->permission_model, // foreign key model
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
        ]);
        $this->crud->addColumn([
            'name'  => 'guard_name',
            'label' => trans('backpack::permissionmanager.guard_type'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            'priority' => 3,
            ]);  
    }

protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
    // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            ]);
        $this->crud->addColumn([
            'name'  => 'name',
            'label' =>  trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'label'     => ucfirst(trans('backpack::permissionmanager.permission_plural')),
            'type'      => 'select_multiple',
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
 //           'model'     => $this->permission_model, // foreign key model
  //          'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ]);
        $this->crud->addColumn([
            'name'      => 'users',
            'label'     => trans('backpack::permissionmanager.users'),
            'type'      => 'select_multiple',
            'entity'    => 'users',
            'attribute' => 'name',
 //           'model'     => $this->role_model,
 //           'pivot'     => true,
            ]); 
        $this->crud->addColumn([
            'name'  => 'guard_name',
            'label' => trans('backpack::permissionmanager.guard_type'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([    
            'name'  => 'created_at',
            'label' => trans('common.created_at'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            ]);       
    }      

    public function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
    // ------ CRUD FIELDS
        $this->addFields();
        //otherwise, changes won't have effect
        \Cache::forget('spatie.permission.cache');
    }

    public function setupUpdateOperation()
    {
        $this->crud->setValidation(UpdateRequest::class);
    // ------ CRUD FIELDS
        $this->addFields();
        //otherwise, changes won't have effect
        \Cache::forget('spatie.permission.cache');
    }

    protected function setupAvancedOperation()
    {   
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('name');
    // ------ CRUD FILTERS
        // daterange filter
        $this->setFilterDateUpdate();
    }
 
    private function addFields()
    {
    // ------ CRUD FIELDS
    //DATA
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        if (config('backpack.permissionmanager.multiple_guards')) {
        $this->crud->addField([
            'name'      => 'guard_name',
            'label'     => trans('backpack::permissionmanager.guard_type'),
            'type'      => 'select_from_array',
            'tab'       => 'Data',
            'options'   => $this->getGuardTypes(),
            ]);
        }
        $this->crud->addField([
            'label'     => ucfirst(trans('backpack::permissionmanager.permission_plural')),
            'type'      => 'checklist',
            'name'      => 'permissions',
            'tab'       => 'Data',
            'entity'    => 'permissions',
            'attribute' => 'name',
            'model'     => $this->permission_model,
            'pivot'     => true,
            ]);
    //INFO
        $this->getInfoFields();

    }

    /*
     * Get an array list of all available guard types
     * that have been defined in app/config/auth.php
     *
     * @return array
     **/
    private function getGuardTypes()
    {
        $guards = config('auth.guards');

        $returnable = [];
        foreach ($guards as $key => $details) {
            $returnable[$key] = $key;
        }

        return $returnable;
    }
}
