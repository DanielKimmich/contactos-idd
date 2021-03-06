<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldContinentRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\WorldContinent;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class WorldContinentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorldContinentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; }   
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation; 
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    public function setup()
    {   
        $this->crud->setModel('App\Models\WorldContinent');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worldcontinent');
        $this->crud->setEntityNameStrings( trans('world.continent.title'),  trans('world.continent.titles'));

        $this->setAccessOperation('worldcontinent');

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
        $this->crud->addColumn([
            'name'  => 'name',
            'label' =>  trans('world.continent.name'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.continent.code'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([
            'name'  => 'countries',
            'label' => trans('world.continent.countries'),
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
/*
   'visibleInTable' => false, // no point, since it's a large text
   'visibleInModal' => false, // would make the modal too big
   'visibleInExport' => false, // not important enough
   'visibleInShow' => true, // sure, why not
*/
    //$this->crud->setDefaultPageLength(10); // number of rows shown in list view
    //$this->crud->setPageLengthMenu([10, 20, 30]); // page length menu to show in the list view
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
            'label' =>  trans('world.continent.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.continent.code'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'countries',
            'label' => trans('world.continent.countries'),
            'type'  => 'relationship_count',
            'suffix'    => '',
        ]);      
    //INFO
        $this->getInfoColumns();
    }

    protected function setupCreateOperation()
    {
    // ------ CRUD FIELDS
        $this->crud->setValidation(WorldContinentRequest::class);
    //DATA
        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' =>  trans('world.continent.name'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-8'],
        ]);
        $this->crud->addField([ // Text
            'name'  => 'code',
            'label' => trans('world.continent.code'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
    //INFO
        $this->getInfoFields();
    }


    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES    
        $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        // daterange filter
        $this->setFilterDateUpdate();
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
/*
protected function setupPrintDefaults()
{
    $this->crud->allowAccess('print');

    $this->crud->operation('print', function() {
       $this->crud->macro('getColumnsInTheFormatIWant', function() {
            $columns = $this->columns();
            // ... do something to $columns;
            return $columns;
        });
    });
}
*/
}
