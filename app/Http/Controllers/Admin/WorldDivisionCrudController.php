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
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; }   
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\WorldDivision');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worlddivision');
        $this->crud->setEntityNameStrings( trans('world.division.title'),  trans('world.division.titles'));

        $this->setAccessOperation('worlddivision');
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
        ]);
        $this->crud->addColumn([ // Text
            'name'  => 'name',
            'label' =>  trans('world.division.name'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.division.code'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.division.country'),
            'type'  => 'select',
            'priority' => 2,
            'entity' => 'country', 
            'attribute' => 'name'
        ]);
        $this->crud->addColumn([
            'name'  => 'cities',
            'label' => trans('world.division.cities'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix'    => '',
        ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'priority' => 4,
            'searchLogic' => false,
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
            'label' =>  trans('world.division.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.division.code'),
            'type'  => 'text',
        ]);
/*        $this->crud->addColumn([
            'name'  => 'has_city',
            'label' => trans('world.division.has_city'),
            'type'  => 'check',
            ]);  */    
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.division.country'),
            'type'  => 'select',
            'entity' => 'country', 
            'attribute' => 'name'
        ]); 
        $this->crud->addColumn([
            'name'  => 'cities',
            'label' => trans('world.division.cities'),
            'type'  => 'relationship_count',
            'suffix'    => '',
        ]);
    //INFO
        $this->getInfoColumns();
    }

    protected function setupCreateOperation()
    {
    // ------ CRUD FIELDS
        $this->crud->setValidation(WorldDivisionRequest::class);
    //DATA
        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' => trans('world.division.name'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-8'],
        ]);
        $this->crud->addField([ // Text
            'name'  => 'code',
            'label' => trans('world.division.code'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        $this->crud->addField([ // Select
            'name'  => 'country_id',
            'label' => trans('world.division.country'),
            'type'  => 'select2',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
            'entity' => 'country', 
            'model' => 'App\Models\WorldCountry', // foreign key model
            'attribute' => 'name',
            'default' => Config::get('settings.world_country'), // set default value
            'options' => (function ($query) { 
               return $query->orderBy('name', 'ASC')->get(); })
        ]);
        $this->crud->addField([ // Text
            'name'  => 'full_name',
            'label' => trans('world.division.full_name'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
        ]);
/*        $this->crud->addField([ // CheckBox
            'name'  => 'has_city',
            'label' => trans('world.division.has_city'),
            'type'  => 'checkbox',
            'tab'   => trans('world.data'),
            ]);     */
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
            'label' => trans('world.division.country'),
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
