<?php

//namespace Backpack\PermissionManager\app\Http\Controllers;
namespace App\Http\Controllers\Admin;
//use Backpack\PermissionManager\app\Http\Controllers\PermissionCrudController as OriginalPermissionCrudController;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController as OriginalPermissionCrudController;
use Backpack\PermissionManager\app\Http\Requests\PermissionStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\PermissionUpdateCrudRequest as UpdateRequest;
use App\Models\ContentType;

// VALIDATION

class PermissionCrudController extends OriginalPermissionCrudController
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

        $this->crud->setModel($permission_model);
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.permission_singular'), trans('backpack::permissionmanager.permission_plural'));
        $this->crud->setRoute(backpack_url('permission'));

        $this->setAccessOperation('authpermission');
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
            'name'      => 'roles',
            'label'     => trans('backpack::permissionmanager.roles'),
            'type'      => 'relationship_count',
            'priority'  => 3,
            'suffix'    => '',
            ]);  


        $this->crud->addColumn([
            'name'      => 'users',
            'label'     => trans('backpack::permissionmanager.extra_permissions'),
            'type'      => 'relationship_count',
            'priority'  => 3,
            'suffix'    => '',
            ]); 
/*        $this->crud->addColumn([
            'label'     => trans('backpack::permissionmanager.roles'),
            'type'      => 'select_multiple',
            'name'      => 'roles',
            'priority'  => 2,
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $this->role_model,
            ]);  */          
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
            'priority' => 4,
            'searchLogic' => false,
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
            ]); 

        $this->crud->addColumn([
            'name'      => 'users',
            'label'     => trans('backpack::permissionmanager.extra_permissions'),
            'type'      => 'select_multiple',
            'entity'    => 'users',
            'attribute' => 'name',
            ]); 
        $this->crud->addColumn([
            'name'  => 'guard_name',
            'label' => trans('backpack::permissionmanager.guard_type'),
            'type'  => 'text',
            ]);
    //INFO
        $this->getInfoColumns();
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

        // User Filter
        $this->crud->addFilter([
            'name'  => 'users',
            'label' => trans('backpack::permissionmanager.extra_permissions'),
            'type'  => 'dropdown',
            ],
            config('backpack.permissionmanager.models.user')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'users', function ($query) use ($value) {
                    $query->where('model_id', '=', $value);
                });
            });

        // Modulo
        $this->crud->addFilter([
            'name' => 'name_module',
            'label' => trans('backpack::permissionmanager.module'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeModules(),
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'name', 'LIKE', "$value%");
            }); 

        // Operacion
        $this->crud->addFilter([
            'name' => 'name_operation',
            'label' => trans('backpack::permissionmanager.operation'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeOperations(),
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'name', 'LIKE', "%$value");
            }); 
        
        // daterange filter
        $this->setFilterDateUpdate();
    }
 
    private function addFields()
    {
    // ------ CRUD FIELDS
    //DATA
/*        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
*/
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text_from_modal',
            'tab'   => 'Data',
            'separate'  => '.',
            'modal_class' => 'modal-dialog',
            'fields' => [
                [   'name' => 'module',
                    'label' => trans('backpack::permissionmanager.module'),
                    'type' => 'select_from_array',
                //    'attributes' => ['return_value' => 'text'],
                    'options'   => ContentType::getTypeModules(),
                    'allows_null' => false,
                ],                
                [   'name' => 'operation',
                    'label' => trans('backpack::permissionmanager.operation'),
                    'type' => 'select_from_array',
                //    'attributes' => ['return_value' => 'text'],
                    'options'   => ContentType::getTypeOperations(),
                    'allows_null' => false,
                ],
            ],
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
