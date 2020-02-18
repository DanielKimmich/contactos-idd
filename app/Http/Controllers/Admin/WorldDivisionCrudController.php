<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldDivisionRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Config;

/**
 * Class WorldDivisionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorldDivisionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; }   
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\WorldDivision');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worlddivision');
        $this->crud->setEntityNameStrings( trans('world.division'),  trans('world.divisions'));

        $this->setupAvancedOperation();
        $this->setAccessOperation('worlddivision');
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
        $this->crud->addColumn([ // Text
            'name'  => 'name',
            'label' =>  trans('world.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            'priority' => 1,]);
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.country'),
            'type'  => 'select',
            'priority' => 2,
            'entity' => 'country', 
            'attribute' => 'name'
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
    // ------ CRUD COLUMNS SHOW
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            ]);
        $this->crud->addColumn([
            'name'  => 'name',
            'label' =>  trans('world.name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'has_city',
            'label' => trans('world.has_city'),
            'type'  => 'check',
            ]);      
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.country'),
            'type'  => 'select',
            'entity' => 'country', 
            'attribute' => 'name'
            ]); 
        $this->crud->addColumn([    
            'name'  => 'created_at',
            'label' => trans('world.created_at'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            ]);       
    }

    protected function setupCreateOperation()
    {
    // ------ CRUD FIELDS
        $this->crud->setValidation(WorldDivisionRequest::class);
    //DATA
        $this->crud->addField([ // Text
            'tab'   => 'Data',
            'name'  => 'name',
            'label' => trans('world.name'),
            'type'  => 'text',
            ]);
        $this->crud->addField([ // Text
            'tab'   => 'Data',
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            ]);
        $this->crud->addField([ // Select
            'tab'   => 'Data',
            'name'  => 'country_id',
            'label' => trans('world.country'),
            'type'  => 'select2',
            'entity' => 'country', 
            'attribute' => 'name',
            'default' => Config::get('settings.world_country'), // set default value
            'options' => (function ($query) { 
               return $query->orderBy('name', 'ASC')->get(); })
            ]);
        $this->crud->addField([ // Text
            'tab'   => 'Data',
            'name'  => 'full_name',
            'label' => trans('world.full_name'),
            'type'  => 'text',
            ]);
        $this->crud->addField([ // CheckBox
            'tab'   => 'Data', 
            'name'  => 'has_city',
            'label' => trans('world.has_city'),
            'type'  => 'checkbox',
            ]);
    //INFO
        $this->getInfoFields();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES    
        $this->crud->orderBy('country_id');
        $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        // country filter
        $this->crud->addFilter([
            'name'  => 'country_id',
            'label' => trans('world.country'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\WorldCountry::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'country_id', $value ); });
/*
        $this->crud->addFilter([
            'name'  => 'has_city',
            'label' => trans('world.has_city'),
            'type'  => 'simple'
            ],
            false,
            function() {
                 $this->crud->addClause('where', 'has_city', 1 ); });
*/
        // daterange filter
        $this->setFilterDateUpdate();
    }
 
    public function clone($id)
    {
        $this->crud->hasAccessOrFail('clone');

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();
    // whatever you want
        $clonedEntry->name = $clonedEntry->name .' '. '[clone]';

        return (string) $clonedEntry->push();
    }
    
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
