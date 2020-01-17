<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldDivisionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
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
        $this->setupAccessOperation();
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
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
         // ------ CRUD COLUMNS
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
        $this->crud->setValidation(WorldDivisionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
                // ------ CRUD FIELDS
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
        if ( $this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'tab'   => 'Info',
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'attributes' => ['readonly'  => 'readonly'],   
            ]);    // ->beforeField('country_id'); 
         $this->crud->addField([ // Text
            'tab'   => 'Info',
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'attributes' => ['disabled'  => 'disabled']   
            ]);     
         $this->crud->addField([ // Text
            'tab'   => 'Info',           
            'name'  => 'created_at',
            'label' => trans('world.created_at'),
            'type'  => 'text',
            'attributes' => ['disabled'  => 'disabled']   
            ]);   
        }
    }

    protected function setupAvancedOperation()
    {
        // ------ ADVANCED QUERIES    
        $this->crud->orderBy('country_id');
        $this->crud->orderBy('name');

        // ------ CRUD FILTERS
        //    $this->crud->filters();
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
        $this->crud->addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to',
            'label' => 'Date range'],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'updated_at', '>=', $dates->from);
                $this->crud->addClause('where', 'updated_at', '<=', $dates->to . ' 23:59:59');
            });
    }
 
    protected function setupAccessOperation()
    {
    // ------ CRUD ACCESS
        $ruta = 'worlddivision';
        if (auth()->user()->can('list '.$ruta ) ) {
            $this->crud->allowAccess('list');
            $this->crud->enableExportButtons(); // ------ DATATABLE EXPORT BUTTONS
        } else {
            $this->crud->denyAccess('list');
        }
        if (auth()->user()->can('create '.$ruta ) ) {
            $this->crud->allowAccess('create');
            $this->crud->allowAccess('clone');
            $this->crud->allowAccess('bulkClone');
        } else {
            $this->crud->denyAccess('create');
            $this->crud->denyAccess('clone');
            $this->crud->denyAccess('bulkClone');
        }
        if (auth()->user()->can('update '.$ruta) ) {
            $this->crud->allowAccess('update');
        } else {
            $this->crud->denyAccess('update');
        } 
        if (auth()->user()->can('show '.$ruta) ) {
            $this->crud->allowAccess('show');
        } else {
            $this->crud->denyAccess('show');
        }
        if (auth()->user()->can('delete '.$ruta) ) {
            $this->crud->allowAccess('delete');
            $this->crud->allowAccess('bulkDelete');
        } else {
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('bulkDelete');
        }
        // ------ CRUD BUTTONS
        if (auth()->user()->hasAnyPermission(['delete '.$ruta, 'create '.$ruta]))  { 
         //   $this->crud->enableBulkActions();
        } 
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
