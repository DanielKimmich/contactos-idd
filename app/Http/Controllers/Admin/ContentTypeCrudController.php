<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContentTypeRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ContentAlias;
use App\Models\ContentType;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContentType');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contenttype');
        $this->crud->setEntityNameStrings(trans('contact.type.entity_name'), trans('contact.type.entity_names'));
        $this->setAccessOperation('contactsetting');
    }

    protected function setupListOperation()
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
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select_from_array',
            'priority' => 4,
            'options' => ContentType::getMimeType(),
            ]);
        CRUD::addColumn([
            'name'  => 'parent_id',
            'label' => trans('contact.type.parent'),
            'type'  => 'select',
            'priority'  => 2,
            'entity'    => 'parent',
            'attribute' => 'label',
            ]);
        $this->crud->addColumn([
            'name'  => 'depth',
            'label' => trans('contact.type.level'),
            'type'  => 'text',
            'priority' => 3,
            ]);     
        $this->crud->addColumn([
            'name'  => 'order',
            'label' => trans('contact.type.order'),
            'type' => 'closure',
            'priority' => 3,
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('lft');
                },
            'function' => function($entry) {
                return $entry->lft.' - '.$entry->rgt;
                }
            ]);     
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
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
            'name'  => 'type',
            'label' => trans('contact.type.type'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'label',
            'label' => trans('contact.type.label'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select_from_array',
            'options' => ContentType::getMimeType(),
            ]);
        CRUD::addColumn([
            'name'  => 'parent_id',
            'label' => trans('contact.type.parent'),
            'type'  => 'select',
            'entity'    => 'parent',
            'attribute' => 'label',
            ]);
        $this->crud->addColumn([
            'name'  => 'depth',
            'label' => trans('contact.type.level'),
            'type'  => 'text',
            ]); 
        $this->crud->addColumn([
            'name'  => 'order',
            'label' => trans('contact.type.order'),
            'type' => 'closure',
            'function' => function($entry) {
                    return $entry->lft.' - '.$entry->rgt;
                }
            ]);         
         $this->crud->addColumn([
            'name'  => 'extras',
            'label' => trans('contact.type.extras'),
            'type'  => 'text',
            ]);
    //INFO
        $this->getInfoColumns();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContentTypeRequest::class);
// ------ CRUD FIELDS
        $this->crud->addField([ // TYPE
            'name'  => 'type',
            'label' => trans('contact.type.type'),
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
        ]);
        $this->crud->addField([ // LABEL
            'name'  => 'label',
            'label' => trans('contact.type.label'),
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
        ]);
        $this->crud->addField([ // MIMETYPE
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select_from_array',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], 
            'options' => ContentType::getMimeType(),
            'allows_null' => true,
        ]);
        CRUD::addField([
            'name'  => 'parent_id',
            'label' => trans('contact.type.parent'),
            'type'  => 'select',
            'tab'   => trans('contact.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
            'entity'    => 'parent',
            'attribute' => 'label',
            'model' => "App\Models\ContentType",
            'options'   => (function ($query) {
            //    return $query->where('depth', 1)->orWhereNull('depth')->orderBy('label', 'ASC')->get(); }),
                return $query->orderBy('label', 'ASC')->get(); }),
            'allows_null' => true, 
        ]);
/*        $this->crud->addField([ // MIMETYPE
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'select_from_array',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
            'options' => $this->getMimeType(),
            'allows_null' => true,
            ]); */
/*
        $this->crud->addField([ // LABEL
            'name'  => 'extras',
            'label' => trans('contact.type.extras'),
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
            ]);
*/

    //EXTRA
         $this->crud->addField([
            'name'  => 'extras',
            'label' => trans('contact.type.extras'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.data'),
            'fields' => [
                [   
                    'name'  => 'data1',
                    'label' => trans('contact.person.sex'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options'   => ContentType::getTypeSexes(),
                    'allows_null' => true,
                ],  
                [   
                    'name'  => 'data2',
                    'label' => trans('contact.parent.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeAllRelations(),
                    'allows_null' => true,
                ],
            ],
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
        $this->crud->orderBy('id');

    // ------ CRUD FILTERS
        //parent filter
        $this->crud->addFilter([
            'name'  => 'mimetype',
            'label' => trans('contact.type.mimetype'),
            'type'  => 'dropdown',
            ],
            function() {
            //    return \App\Models\ContentType::where('depth', '1')->orWhereNull('depth')->orderBy('label')->pluck('label', 'id')->toArray(); },
                return \App\Models\ContentType::where('depth', '1')->orderBy('label')->pluck('label', 'type')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'mimetype', $value ); });

        // FirstLevel filter
        $this->crud->addFilter([
            'name' => 'depth',
            'label'=> trans('contact.type.firstlevel'),
            'type' => 'simple',
        ], 
        false, 
        function() { // if the filter is active
            $this->crud->addClause('where', 'depth', '1'); } );

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

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'label');
        CRUD::set('reorder.max_level', 3);
    }

}
