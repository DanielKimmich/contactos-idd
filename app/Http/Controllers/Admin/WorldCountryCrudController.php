<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldCountryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
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
/*
   'visibleInTable' => false, // no point, since it's a large text
   'visibleInModal' => false, // would make the modal too big
   'visibleInExport' => false, // not important enough
   'visibleInShow' => true, // sure, why not
*/
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
        $this->crud->setValidation(WorldCountryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        // ------ CRUD FIELDS
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

    if ( $this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'tab'   => 'Info',
            'prefix'   => "<i class='fa fa-info'></i>", // Agregado por DK
            'attributes' => ['readonly'  => 'readonly'],   
            ] ); // ->beforeField('name'); 
         $this->crud->addField([ // Text
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'prefix'   => "<i class='fa fa-calendar'></i>", // Agregado por DK
            'attributes' => ['disabled'  => 'disabled']   
            ] ) ;     
         $this->crud->addField([ // Text
            'name'  => 'created_at',
            'label' => trans('world.created_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'prefix'   => "<i class='fa fa-calendar'></i>", // Agregado por DK
            'attributes' => ['disabled'  => 'disabled']   
            ] );  
        } 
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
        $ruta = 'worldcountry';
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
