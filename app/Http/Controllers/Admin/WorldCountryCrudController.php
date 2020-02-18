<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldCountryRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Config;

/**
 * Class WorldCountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorldCountryCrudController extends CrudController
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
        $this->crud->setModel('App\Models\WorldCountry');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worldcountry');
        $this->crud->setEntityNameStrings(trans('world.country'),  trans('world.countries'));

        $this->setupAvancedOperation();
        $this->setAccessOperation('worldcountry');

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
        $this->crud->addColumn([ // Text
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            'priority' => 1,
            ]); 
        $this->crud->addColumn([ // Text
            'name'  => 'capital',
            'label' =>  trans('world.capital'),
            'type'  => 'text',
            'priority' => 3,
            'orderable' => false,
            ]);
        $this->crud->addColumn([
            'name'  => 'callingcode',
            'label' => trans('world.calling_code'),
            'type'  => 'number',
            'priority' => 3,
            ]);      
        $this->crud->addColumn([ // Select
            'name'  => 'continent_id',
            'label' => trans('world.continent'),
            'type'  => 'select',
            'entity' => 'continent', 
            'attribute' => 'name',
            'priority' => 2,
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
            'name'  => 'code_alpha3',
            'label' => trans('world.code_alpha3'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'full_name',
            'label' => trans('world.full_name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([ // Text
            'name'  => 'capital',
            'label' =>  trans('world.capital'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'has_division',
            'label' => trans('world.has_division'),
            'type'  => 'check',
            ]);      
        $this->crud->addColumn([
            'name'  => 'currency_code',
            'label' => trans('world.currency_code'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'currency_name',
            'label' => trans('world.currency_name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'tld',
            'label' => trans('world.tld'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'callingcode',
            'label' => trans('world.calling_code'),
            'type'  => 'number',
            ]);
        $this->crud->addColumn([ // Select
            'name'  => 'continent_id',
            'label' => trans('world.continent'),
            'type'  => 'select',
            'entity' => 'continent', 
            'attribute' => 'name',
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
        $this->crud->setValidation(WorldCountryRequest::class);
    //DATA
        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' => trans('world.name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);    
        $this->crud->addField([ // Text
            'name'  => 'code',
            'label' => trans('world.code'),
            'type'  => 'text',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields 
            ]);
        $this->crud->addField([ // Text
            'name'  => 'code_alpha3',
            'label' => trans('world.code_alpha3'),
            'type'  => 'text',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields 
            ]);
        $this->crud->addField([ // Select
            'name'  => 'continent_id',
            'label' => trans('world.continent'),
            'type'  => 'select',
            'tab'   => 'Data',
            'entity' => 'continent', 
            'attribute' => 'name',
            'model' => "App\Models\WorldContinent",
            'default' => Config::get('settings.world_continent'), // set default value
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get(); }), 
            ]);
        $this->crud->addField([ // Text
            'name'  => 'full_name',
            'label' => trans('world.full_name'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // Text
            'name'  => 'capital',
            'label' => 'Capital',
            'type'  => 'text',
            'tab'   => 'Data',
            ]);

        $this->crud->addField([ // Text
            'name'  => 'emoji',
            'label' => 'Emoji',
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // CheckBox
            'name'  => 'has_division',
            'label' => trans('world.has_division'),
            'type'  => 'checkbox',
            'tab'   => 'Data',
            ]);
        $this->crud->addField([ // Text
            'name'  => 'currency_code',
            'label' => trans('world.currency_code'),
            'type'  => 'text',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields
            ]);
        $this->crud->addField([ // Text
            'name'  => 'currency_name',
            'label' => trans('world.currency_name'),
            'type'  => 'text',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields
            ]);
       $this->crud->addField([ // Text
            'name'  => 'tld',
            'label' => trans('world.tld'),
            'type'  => 'text',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields
            ]);
        $this->crud->addField([ // Number
            'name'  => 'callingcode',
            'label' => trans('world.calling_code'),
            'type'  => 'number',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields
            ]);
    //INFO
        $this->getInfoFields();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES    
        $this->crud->orderBy('continent_id');
        $this->crud->orderBy('name');

    // ------ CRUD FILTERS
  //    $this->crud->filters();
        $this->crud->addFilter([
            'name'  => 'continent_id',
            'label' => trans('world.continent'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\WorldContinent::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'continent_id', $value ); });
/*
        $this->crud->addFilter([
            'name'  => 'has_division',
            'label' => trans('world.has_division'),
            'type'  => 'simple'
            ],
            false,
             function() {
                 $this->crud->addClause('where', 'has_division', 1 ); });
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
