<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\AuthCheckerRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AuthCheckerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuthCheckerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\AuthChecker');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/authchecker');
        $this->crud->setEntityNameStrings(trans('report.authchecker.title'), trans('report.authchecker.titles'));

        $this->setupAvancedOperation();
    }

    protected function setupListOperation()
    {
    // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]);
        $this->crud->addColumn([
            'name'  => 'users.name',
            'label' =>  trans('report.authchecker.user_name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'devices.operating_system',
            'label' =>  trans('report.authchecker.operating_system'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'devices.web_browser',
            'label' =>  trans('report.authchecker.web_browser'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'devices.device',
            'label' =>  trans('report.authchecker.device'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'ip_address',
            'label' =>  trans('report.authchecker.ip_address'),
            'type'  => 'text',
            'priority' => 4,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('report.authchecker.logged_at'),
            'type'  => 'text',
            'priority' => 2,
            ]);
        $this->crud->addColumn([
            'name'  => 'type',
            'label' => trans('report.authchecker.status'),
            'type'  => 'text',
            'priority' => 2,
            ]);
    // remove a column from the stack
        $this->crud->removeAllButtons();
     //   $this->crud->disableResponsiveTable();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES    
        $this->crud->orderBy('updated_at', 'desc');

    // ------ CRUD FILTERS
        //User
        $this->crud->addFilter([
            'name'  => 'user_id',
            'label' => trans('report.authchecker.user_name'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\BackpackUser::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'user_id', $value ); });

        //Status
        $this->crud->addFilter([
            'name'  => 'type',
            'label' => trans('report.authchecker.status'),
            'type'  => 'dropdown',
            ],
            function() {
            //    return array('auth', 'failed', 'lockout'); },
                return $this->crud->model->getTypeStatus(); },
            function($value) {  
                $this->crud->addClause('where', 'type', $value ); });

        // daterange filter
        $this->setFilterDateUpdate();
    }


}
