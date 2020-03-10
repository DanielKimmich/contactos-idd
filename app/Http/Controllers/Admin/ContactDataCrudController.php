<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactDataRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactDataCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactDataCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContactEvent');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crud->setEntityNameStrings('contactdata', 'contact_datas');

        $this->setupAvancedOperation();
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContactDataRequest::class);

        // TODO: remove setFromDb() and manually define Fields
    //    $this->crud->setFromDb();

        $this->crud->addField([        
          //  'name'  => 'data8',
            'name'  => 'event_type',
            'label' => 'data2',
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'attributes' => ['id' => 'event_type'],
            //   'key'   => 'events.type',
        //    'value' => 'TYPE_BIRTHDAY',
       //     'entity' => 'events', 
        //     'fake' => true,
        //      'store_in' => 'data4', // [optional]
         //    'pivot' => true,  
          //   'morph' => true, 
         //    'model' => 'App\Models\ContactEvent',         
            ]);       

        $this->crud->addField([
            'name'  => 'event_date',
            'label' => trans('contact.event.birthday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'attributes' => ['id' => 'event_date'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
      //      'key'   => 'events.date',
       //     'entity' => 'events',
      //      'fake' => true, 
       //     'store_in' => 'data6', // [optional]
        //    'pivot' => true,
        //    'morph' => true,
       //     'model' => 'App\Models\ContactEvent',
            ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
       // $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        // Role Filter
/*
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
*/
        // daterange filter
        $this->setFilterDateUpdate();
    }
}
