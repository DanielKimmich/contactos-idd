<?php

//namespace Backpack\PermissionManager\app\Http\Controllers;
namespace App\Http\Controllers\Admin;
//use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as OriginalUserCrudController;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController as OriginalUserCrudController;
use Backpack\PermissionManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserCrudController extends OriginalUserCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;


    public function setup()
    {
        $this->crud->setModel(config('backpack.permissionmanager.models.user'));
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
        $this->crud->setRoute(backpack_url('user'));

        $this->setAccessOperation('authuser');
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
            'name'  => 'email',
            'label' => trans('backpack::permissionmanager.email'),
            'type'  => 'email',
            'priority' => 2,
            ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'name'      => 'roles', // the method that defines the relationship in your Model
            'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
            'type'      => 'select_multiple',
            'priority' => 3,
            'entity'    => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => config('permission.models.role'), // foreign key model
            ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
            'type'      => 'select_multiple',
            'priority' => 4,
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => config('permission.models.permission'), // foreign key model
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
            'name'  => 'email',
            'label' => trans('backpack::permissionmanager.email'),
            'type'  => 'email',
            ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'name'      => 'roles', // the method that defines the relationship in your Model
            'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
            'type'      => 'select_multiple',
            'entity'    => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
//            'model'     => config('permission.models.role'), // foreign key model
            ]);
        $this->crud->addColumn([
           // run a function on the CRUD model and show its return value
           'name' => "url",
           'label' => ucfirst(trans('backpack::permissionmanager.permission_plural')),
          'type' => "model_function",
          'function_name' => 'PermissionsViaRoles', // the method in your Model
           // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
          // 'limit' => 100, // Limit the number of characters shown
        ]);

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
            'type'      => 'select_multiple',
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
  //          'model'     => config('permission.models.permission'), // foreign key model
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
        $this->addUserFields();
        $this->crud->setValidation(StoreRequest::class);
    }

    public function setupUpdateOperation()
    {
        $this->addUserFields();
        $this->crud->setValidation(UpdateRequest::class);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
//        $this->crud->request = $this->crud->validateRequest();
//        $this->crud->request = $this->handlePasswordInput($this->crud->request);
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
//        $this->crud->request = $this->crud->validateRequest();
//        $this->crud->request = $this->handlePasswordInput($this->crud->request);
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }

    /**
     * Handle password input fields.
     */
    protected function handlePasswordInput($request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');
        $request->request->remove('roles_show');
        $request->request->remove('permissions_show');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        return $request;
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

        // Extra Permission Filter
        $this->crud->addFilter([
            'name'  => 'permissions',
            'label' => trans('backpack::permissionmanager.extra_permissions'),
            'type'  => 'select2',
            ],
            config('permission.models.permission')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'permissions', function ($query) use ($value) {
                    $query->where('permission_id', '=', $value);
                });
            });

        // daterange filter
            $this->setFilterDateUpdate();
    }
 
    protected function addUserFields()
    {
    // ------ CRUD FIELDS
    //DATA
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([
            'name'  => 'email',
            'label' => trans('backpack::permissionmanager.email'),
            'type'  => 'email',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([
            'name'  => 'password',
            'label' => trans('backpack::permissionmanager.password'),
            'type'  => 'password',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([
            'name'  => 'password_confirmation',
            'label' => trans('backpack::permissionmanager.password_confirmation'),
            'type'  => 'password',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([
        // two interconnected entities
            'label'             => trans('backpack::permissionmanager.user_role_permission'),
            'field_unique_name' => 'user_role_permission',
            'type'              => 'checklist_dependency',
            'name'              => ['roles', 'permissions'],
            'tab'   => 'Permission',                
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => 'name', // foreign key attribute that is shown to user
                        'model'            => config('permission.models.role'), // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => 'name', // foreign key attribute that is shown to user
                        'model'          => config('permission.models.permission'), // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
        ]);

    //INFO
        $this->getInfoFields();
    }
}
