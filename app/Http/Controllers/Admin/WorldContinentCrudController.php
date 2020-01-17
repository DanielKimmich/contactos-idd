<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldContinentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WorldContinentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorldContinentCrudController extends CrudController
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
        $this->crud->setModel('App\Models\WorldContinent');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worldcontinent');
        $this->crud->setEntityNameStrings( trans('world.continent'),  trans('world.continents'));
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
        $this->crud->addColumn([
            'name'  => 'name',
            'label' =>  trans('world.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            'priority' => 1,
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
        $this->crud->setValidation(WorldContinentRequest::class);
        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        // ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' =>  trans('world.name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // Text
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
      if ($this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['readonly'  => 'readonly'],   
            ]);     // ->beforeField('name'); 
         $this->crud->addField([ // Text
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled']   
            ]);     
         $this->crud->addField([ // Text
            'name'  => 'created_at',
            'label' => trans('world.created_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled']   
            ]);   
      }

    }


    protected function setupAvancedOperation()
    {
        // ------ ADVANCED QUERIES    
        $this->crud->orderBy('name');

        // ------ CRUD FILTERS
        // daterange filter
        $this->crud->addFilter([
            'name'  => 'from_to',
            'label' => trans('world.date_range'),
            'type'  => 'date_range',
            ],
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
        $ruta = 'worldcontinent';
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

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function clone($id)
    {
        $this->crud->hasAccessOrFail('clone');

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();
    // whatever you want
        $clonedEntry->name = $clonedEntry->name .' '. '[clone]';

        return (string) $clonedEntry->push();
    }
}
