<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorldCityRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Config;

/**
 * Class WorldCityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorldCityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; }   
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation; 
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
 //   use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\WorldCity');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/worldcity');
        $this->crud->setEntityNameStrings(trans('world.city.title'), trans('world.city.titles'));

        $this->setAccessOperation('worldcity');
 
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
        ]); // -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'name',
            'label' =>  trans('world.city.name'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.city.code'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        $this->crud->addColumn([ // Select
            'name'  => 'division_id',
            'label' => trans('world.city.division'),
            'type'  => 'select',
            'entity' => 'division', 
            'attribute' => 'name',
            'priority' => 3,
        ]);
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.city.country'),
            'type'  => 'select',
            'entity' => 'country', 
            'attribute' => 'name',
            'priority' => 3,
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
    // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
        ]);
        $this->crud->addColumn([
            'name'  => 'name',
            'label' =>  trans('world.city.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'code',
            'label' => trans('world.city.code'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'full_name',
            'label' => trans('world.city.full_name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([ // Select
            'name'  => 'division_id',
            'label' => trans('world.city.division'),
            'type'  => 'select',
            'entity' => 'division', 
            'attribute' => 'name',
        ]); 
        $this->crud->addColumn([ // Select
            'name'  => 'country_id',
            'label' => trans('world.city.country'),
            'type'  => 'select',
            'entity' => 'country', 
            'attribute' => 'name',
        ]); 
    //INFO
        $this->getInfoColumns();
    }


    protected function setupCreateOperation()
    {
    // ------ CRUD FIELDS
        $this->crud->setValidation(WorldCityRequest::class);
    //DATA
        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' => trans('world.city.name'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-8'],
        ]);
        $this->crud->addField([ // Text
            'name'  => 'code',
            'label' => trans('world.city.code'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
         $this->crud->addField([ // Select
            'name'  => 'country_id',
            'label' => trans('world.city.country'),
            'type'  => 'select2',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
        //    'entity' => 'country', 
            'model' => 'App\Models\WorldCountry', // foreign key model
            'attribute' => 'name',
            'default' => Config::get('settings.world_country'), // set default value
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get(); }),
        ]);
        $this->crud->addField([ // Select
            'name'  => 'division_id',
            'label' => trans('world.city.division'),
            'type'  => 'relationship',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
        //    'entity' => 'division', 
            'attribute' => 'name',
            'ajax' => true,
            'model' => 'App\Models\WorldDivision', // foreign key model
            'data_source'  => backpack_url('worldcity/fetch/division'), // url to controller search function (with /{id} should return model)
//            'placeholder' => '', // placeholder for the select
            'dependencies'  => ['country_id'], // when a dependency changes, this select2 is reset to null
         //   'dependencies'  => 'country_id',
            'minimum_input_length' => 0, // minimum characters to type before querying results
        ]); 
/*        
        $this->crud->addField([ // Select
            'name'  => 'division_id',
            'label' => trans('world.city.division'),
            'type'  => 'select2_from_ajax',
            'tab'   => trans('world.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
        //    'entity' => 'division', 
            'attribute' => 'name',
            'model' => 'App\Models\WorldDivision', // foreign key model
            'data_source'  => url('admin/searchdivision/country_id'), // url to controller search function (with /{id} should return model)
            'placeholder' => '', // placeholder for the select
            'dependencies'  => ['country_id'], // when a dependency changes, this select2 is reset to null
         //   'dependencies'  => 'country_id',
            'minimum_input_length' => 0, // minimum characters to type before querying results
            ]); 
*/
        $this->crud->addField([ // Text
            'name'  => 'full_name',
            'label' => trans('world.city.full_name'),
            'type'  => 'text',
            'tab'   => trans('world.data'),
        ]);
    //INFO
        $this->getInfoFields();
    }

   protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES    
        $this->crud->orderBy('country_id');
        $this->crud->orderBy('division_id');
        $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        $this->crud->addFilter([
            'name'  => 'country_id',
            'label' => trans('world.city.country'),
            'type'  => 'select2',
        ],
        function() {
            return \App\Models\WorldCountry::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
        function($value) {  
            $this->crud->addClause('where', 'country_id', $value ); 
        });

        $this->crud->addFilter([
            'name'  => 'division_id',
            'label' => trans('world.city.division'),
            'type'  => 'select2_ajax', 
            //'placeholder' => 'Pick a category',
        ],
        url('admin/filterdivision'), // the ajax route
        function($value) {  
            $this->crud->addClause('where', 'division_id', $value ); 
        });

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

    public function fetchDivision()
    {
      //  return $this->fetch('App\Models\WorldDivision');
/*
        $form = $this->crud->getRequest()->input('form');
        foreach ($form as $entry) {
            dump( $entry );
            if ($entry['name'] == 'country_id') {
                $id = (int) $entry['value'];
            }
        }
        dump( $id );
*/
        return $this->fetch([
            'model' => 'App\Models\WorldDivision', // required
            'searchable_attributes' => ['name'],
            'paginate' => 50, // items to show per page
            'query' => function($model) {
                $form = $this->crud->getRequest()->input('form');
                foreach ($form as $entry) {
                    if ($entry['name'] == 'country_id') {
                        $country_id = (int) $entry['value'];
                        break 1;  /* Sólo sale del foreach. */
                    }
                }
                return $model->where('country_id', $country_id)->orderBy('name');
            } // to filter the results that are returned
        ]);
    }

}
