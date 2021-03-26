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
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContactData');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crud->setEntityNameStrings('contactdata', 'contact_datas');

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->setupAvancedOperation();
        $this->crud->setFromDb();
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;        
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            'priority' => 3,
            'searchLogic' => false,
            ]); 
        $this->crud->addColumn([    
            'name'  => 'updated_by_user',
            'label' => trans('common.updated_by'),
            'type'  => 'text',
            'priority' => 3,
            'searchLogic' => false,
            ]); 

        $this->crud->disableResponsiveTable();
        $this->crud->addButtonFromView('top', 'import', 'import', 'end');  
    //    $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');  
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
//    $this->crud->addButtonFromView('top', 'import', 'import', 'end');  
//    $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');   

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    /*    $this->crud->addField([
            'name'  => 'data1',
            'label' => trans('contact.other.name'),
            'type'  => 'relationship',
            'tab'   => trans('contact.other.tab'),
            'wrapper'   => ['class' => 'form-group col-md-8'],           
            'entity'    => 'parent',
            'attribute' => 'display_name',
            'model'     => 'App\Models\ContactPerson',
            'ajax' => false,
            'inline_create' => ['entity' => 'contactperson'],             
        ]);  */
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
 /*               return \App\Models\ContentAlias::all()->sortBy('mimetype')->pluck('mimetype', 'mimetype')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'mimetype', $value ); }); */
                return \App\Models\ContentType::where('depth', '1')->orderBy('label')->pluck('label', 'type')->toArray(); },
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

    public function fetchParent()
    {
        return $this->fetch('App\Models\ContactPerson');
    }

}
