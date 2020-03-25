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
        $this->crud->setModel('App\Models\ContactData');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crud->setEntityNameStrings('contactdata', 'contact_datas');

        $this->setupAvancedOperation();
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->disableResponsiveTable();
    $this->crud->addButtonFromView('top', 'import', 'import', 'end');  
    $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');  
    $this->crud->enableExportButtons(); // ------ DATATABLE EXPORT BUTTONS
     //   $this->crud->addColumns(['id', 'mimetype', 'event_date', 'event_type', 'event_label'] );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContactDataRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();


/*
        $this->crud->addField([
            'name'  => 'event_date',
            'label' => trans('contact.event.birthday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'attributes' => ['id' => 'event_date'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
            ]);

        $this->crud->addField([        
            'name'  => 'event_type',
            'label' => 'data2',
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'attributes' => ['id' => 'event_type'],
            ]);       

        $this->crud->addField([        
            'name'  => 'event_label',
            'label' => 'data3',
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'attributes' => ['id' => 'event_type'],
            ]);   */
    $this->crud->addButtonFromView('top', 'import', 'import', 'end');  
    $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');   

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
        //mimetype filter
        $this->crud->addFilter([
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'dropdown',
            ],
            function() {
                return \App\Models\ContentAlias::all()->sortBy('mimetype')->pluck('mimetype', 'mimetype')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'mimetype', $value ); });

        // daterange filter
        $this->setFilterDateUpdate();
    }


    public function import() 
    {
    // whatever you decide to do
        \Alert::add('info', 'This is a blue bubble.');
    }


}
