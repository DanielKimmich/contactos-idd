<?php

//namespace Backpack\PermissionManager\app\Http\Controllers;
namespace App\Http\Controllers\Admin;
use Backpack\PermissionManager\app\Http\Controllers\PermissionCrudController as OriginalPermissionCrudController;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\PermissionManager\app\Http\Requests\PermissionStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\PermissionUpdateCrudRequest as UpdateRequest;

// VALIDATION

class PermissionCrudController extends OriginalPermissionCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {                      
        $this->role_model = $role_model = config('backpack.permissionmanager.models.role');
        $this->permission_model = $permission_model = config('backpack.permissionmanager.models.permission');

        $this->crud->setModel($permission_model);
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.permission_singular'), trans('backpack::permissionmanager.permission_plural'));
        $this->crud->setRoute(backpack_url('permission'));

        $this->setupAvancedOperation();
        $this->setupAccessOperation();
    }

    public function setupListOperation()
    {
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
            'label'     => trans('backpack::permissionmanager.roles'),
            'type'      => 'select_multiple',
            'name'      => 'roles',
            'priority' => 2,
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $this->role_model,
            'pivot'     => true,
            ]);            
        $this->crud->addColumn([
            'name'  => 'guard_name',
            'label' => trans('backpack::permissionmanager.guard_type'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'priority' => 4,
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
            'name'      => 'roles',
            'label'     => trans('backpack::permissionmanager.roles'),
            'type'      => 'select_multiple',
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $this->role_model,
 //           'pivot'     => true,
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
//        $this->addFields();
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
    // Order
        $this->crud->orderBy('name');

    // Role Filter
        $this->crud->addFilter([
            'name'  => 'role',
            'label' => trans('backpack::permissionmanager.role'),
            'type'  => 'dropdown',
            ],
            config('permission.models.role')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'roles', function ($query) use ($value) {
                    $query->where('role_id', '=', $value);
                });
            });
    // daterange filter
        $this->crud->addFilter([
            'name'  => 'from_to',
            'label' => trans('common.date_range'),
            'type'  => 'date_range',
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'updated_at', '>=', $dates->from);
                $this->crud->addClause('where', 'updated_at', '<=', $dates->to . ' 23:59:59');
            });
    }
 
    protected function setupAccessOperation()
    {
/*
        // deny access according to configuration file
        if (config('backpack.permissionmanager.allow_permission_create') == false) {
            $this->crud->denyAccess('create');
        }
        if (config('backpack.permissionmanager.allow_permission_update') == false) {
            $this->crud->denyAccess('update');
        }
        if (config('backpack.permissionmanager.allow_permission_delete') == false) {
            $this->crud->denyAccess('delete');
        }
*/
    // ------ CRUD ACCESS
        $ruta = 'authpermission';
        if (auth()->user()->can('list '.$ruta ) ) {
            $this->crud->allowAccess('list');
            $this->crud->enableExportButtons(); // ------ DATATABLE EXPORT BUTTONS
        } else {
            $this->crud->denyAccess('list');
        }
        if (auth()->user()->can('create '.$ruta ) ) {
            $this->crud->allowAccess('create');
            $this->crud->allowAccess('clone');
            $this->crud->allowAccess('bulkClone');
        } else {
            $this->crud->denyAccess('create');
            $this->crud->denyAccess('clone');
            $this->crud->denyAccess('bulkClone');
        }
        if (auth()->user()->can('update '.$ruta) ) {
            $this->crud->allowAccess('update');
        } else {
            $this->crud->denyAccess('update');
        } 
        if (auth()->user()->can('show '.$ruta) ) {
            $this->crud->allowAccess('show');
        } else {
            $this->crud->denyAccess('show');
        }
        if (auth()->user()->can('delete '.$ruta) ) {
            $this->crud->allowAccess('delete');
            $this->crud->allowAccess('bulkDelete');
        } else {
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('bulkDelete');
        }
        // ------ CRUD BUTTONS
        if (auth()->user()->hasAnyPermission(['delete '.$ruta, 'create '.$ruta]))  { 
         //   $this->crud->enableBulkActions();
        }  
    }


    private function addFields()
    {
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            'tab'   => 'Data',
//            'prefix'   => "<i class='fa fa-key'></i>", // Agregado por DK
            ]);
        if (config('backpack.permissionmanager.multiple_guards')) {
        $this->crud->addField([
            'name'    => 'guard_name',
            'label'   => trans('backpack::permissionmanager.guard_type'),
            'type'    => 'select_from_array',
            'tab'   => 'Data',
            'options' => $this->getGuardTypes(),
            ]);
        }
        $this->crud->addField([
            'label'     => trans('backpack::permissionmanager.roles'),
            'type'      => 'checklist',
            'name'      => 'roles',
            'tab'       => 'Roles',
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $this->role_model,
            'pivot'     => true,
            ]);
        if ( $this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['readonly'  => 'readonly'],  
            ]);  //->beforeField('country_id'); 
         $this->crud->addField([ // Text
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled'],
            ]);     
         $this->crud->addField([ // Text
            'name'  => 'created_at',
            'label' => trans('common.created_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled'],
            ]);   
        }
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
