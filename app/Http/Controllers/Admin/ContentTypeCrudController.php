<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContentTypeRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ContentAlias;

/**
 * Class ContentTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContentTypeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; } 
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContentType');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contenttype');
        $this->crud->setEntityNameStrings(trans('contact.type.title'), trans('contact.type.titles'));
        $this->setupAvancedOperation();
    //    $this->setAccessOperation('contenttype');
    }

    protected function setupListOperation()
    {
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
         $this->crud->addColumn([
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'type',
            'label' => trans('contact.type.type'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'label',
            'label' => trans('contact.type.label'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'order',
            'label' => trans('contact.type.order'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            'priority' => 4,
            ]); 


    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContentTypeRequest::class);
// ------ CRUD FIELDS
        $this->crud->addField([ // MIMETYPE
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select_from_array',
            'tab'   => 'Data',
            'options' => $this->getMimeType(),
            'allows_null' => true,
            ]);

        $this->crud->addField([ // TYPE
            'name'  => 'type',
            'label' => trans('contact.type.type'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // LABEL
            'name'  => 'label',
            'label' => trans('contact.type.label'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // ORDER
            'name'  => 'order',
            'label' => trans('contact.type.order'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
    //INFO
        $this->getInfoFields(); 
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('mimetype');

    // ------ CRUD FILTERS
        // Role mimetype

        $this->crud->addFilter([
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\ContentAlias::all()->sortBy('mimetype')->pluck('mimetype', 'mimetype')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'mimetype', $value ); });

        // daterange filter
        $this->setFilterDateUpdate();
    }
    
    public function clone($id)
    {
        $this->crud->hasAccessOrFail('clone');

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();
    // whatever you want
        $clonedEntry->label = $clonedEntry->label .' '. '[clone]';

        return (string) $clonedEntry->push();
    }

    public function getMimeType()
    {   
        $mimes = ContentAlias::all();
        $mimetype = $mimes->sortBy('mimetype')->pluck('mimetype','mimetype');
        return $mimetype->toArray();

    }


}
