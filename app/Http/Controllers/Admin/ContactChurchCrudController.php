<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactChurchRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use App\Models\ContentType;
use App\Models\ContactChurch;

/**
 * Class ContactChurchCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactChurchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ContactChurch::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contactchurch');
        CRUD::setEntityNameStrings(trans('contact.church.entity_name'), trans('contact.church.entity_names'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        $this->dashboard();
        $this->setupAvancedOperation();
     // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'display_name',
            'label' =>  trans('contact.church.display_name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'gifts',
            'label' => trans('contact.gift.tab'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'talents',
            'label' => trans('contact.talent.tab'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'ministries',
            'label' => trans('contact.ministry.tab'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.church.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeStatus(),
            ]);        

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */

    protected function setupShowOperation()
    {  // $this->crud->setShowContentClass('col-md-8 col-md-offset-2');
        $this->crud->set('show.setFromDb', false);
    // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            ]);
        $this->crud->addColumn([
            'name'  => 'display_name',
            'label' =>  trans('contact.person.display_name'),
            'type'  => 'text',
            ]);


        $this->crud->addColumn([
            'name' => 'relation_gift', 
            'label' => trans('contact.gift.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_gift'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['data1'];
                        if (empty($item['data3']))
                            $items .= '<br>';
                        else
                            $items .= ' ('. $item['data3'] .')<br>';
                    }
                }
                return $items; 
            }
       ]); 
        $this->crud->addColumn([
            'name' => 'relation_talent', 
            'label' => trans('contact.talent.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_talent'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['data1'];
                        if (empty($item['data3']))
                            $items .= '<br>';
                        else
                            $items .= ' ('. $item['data3'] .')<br>';
                    }
                }
                return $items; 
            }
       ]); 
        $this->crud->addColumn([
            'name' => 'relation_ministry', 
            'label' => trans('contact.ministry.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_ministry'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['data1'];
                        if (empty($item['data3']))
                            $items .= '<br>';
                        else
                            $items .= ' ('. $item['data3'] .')<br>';
                    }
                }
                return $items; 
            }
       ]); 
    //INFO
        $this->getInfoColumns();
    }              

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
       // $this->setupCreateOperation();
        CRUD::setValidation(ContactChurchRequest::class);
        // ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.church.display_name'),
            'type'  => 'text',
            'wrapper'   => ['class' => 'form-group col-md-8'],
            'prefix'    => '<i class="la la-id-card-o"></i>',
            'attributes' => ['readonly' => 'readonly'],
            ]);
        $this->crud->addField([ // Text
            'name'  => 'status',
            'label' => trans('contact.church.status'),
            'type'  => 'select_from_array',
            'wrapper'   => ['class' => 'form-group col-md-4'],
            'options'   => ContentType::getTypeStatus(),
            ]);        

    //DATA
        $this->crud->addField([
            'name'  => 'relation_step',
            'label' => trans('contact.step.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.step.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.step.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeChurchs(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.step.name'),
                    'type'  => 'date',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data4',
                    'label' => trans('contact.step.pastor'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data5',
                    'label' => trans('contact.step.site'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.step.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //GIFT
        $this->crud->addField([
            'name'  => 'relation_gift',
            'label' => trans('contact.gift.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.gift.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.gift.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeGifts(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.gift.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.gift.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //TALENT
        $this->crud->addField([
            'name'  => 'relation_talent',
            'label' => trans('contact.talent.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.talent.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.talent.titles'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeTalents(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.talent.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.talent.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //MINISTRY
        $this->crud->addField([
            'name'  => 'relation_ministry',
            'label' => trans('contact.ministry.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.ministry.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.ministry.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeMinistries(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.ministry.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.ministry.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //INFO
        $this->getInfoFields();        
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('updated_at', 'desc');  // 'asc', 'desc'

    // ------ CRUD FILTERS
        // Genero
        $this->crud->addFilter([
            'name' => 'sex_id',
            'label' => trans('contact.person.sex'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeSexes(),
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'sex_id', $value);
            }); 

        // Dones
        $this->crud->addFilter([
            'name' => 'gift',
            'label' => trans('contact.gift.title'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeGifts(),
            function($value) { // if the filter is active
                if ($value === 'null') {
                    $this->crud->addClause('doesntHave', 'gifts');
                } else {
                    $this->crud->addClause('whereHas', 'gifts', function ($query) use ($value) {
                        $query->where('data2', '=', $value);
                    });
                }
            }); 


        // Talentos
        $this->crud->addFilter([
            'name' => 'talent',
            'label' => trans('contact.talent.title'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeTalents(),
            function($value) { // if the filter is active
                if ($value === 'null') {
                    $this->crud->addClause('doesntHave', 'talents');
                } else {

                    $this->crud->addClause('whereHas', 'talents', function ($query) use ($value) {
                        $query->where('data2', '=', $value);
                    });
                }
            }); 


        // Ministerios
        $this->crud->addFilter([
            'name' => 'ministry',
            'label' => trans('contact.ministry.title'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeMinistries(),
            function($value) { // if the filter is active
                if ($value === 'null') {
                    $this->crud->addClause('doesntHave', 'ministries');
                } else {
                    $this->crud->addClause('whereHas', 'ministries', function ($query) use ($value) { $query->where('data2', '=', $value);
                    });
                }
            }); 
                                
        // Estado
        $this->crud->addFilter([
            'name' => 'status',
            'label' => trans('contact.person.status'),
            'type' => 'select2_multiple',      
            ], 
            function() {return ContentType::getTypeStatus(); },
            function($values) { // if the filter is active
                $this->crud->addClause('whereIn', 'civil_status', json_decode($values));
            });

        // daterange filter
        $this->setFilterDateUpdate();
    }

    public function dashboard()
    {
        // display lead status counts on page top
        $widgets = [
            'type'  => 'div',
            'class' => 'row',
            'content' => [  ] // widgets
        ];  

        $nogiftCount = ContactChurch::doesntHave('gifts')->count();
        $notalentCount = ContactChurch::doesntHave('talents')->count();
        $noministryCount = ContactChurch::doesntHave('ministries')->count();

        if ($nogiftCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $nogiftCount,
                    'description' => trans('contact.gift.not_gift'), 
                    'icon'        => 'la-gift bg-info',
                    'url' => url($this->crud->getRoute() .'?gift=null'),
                ], 
            );
        }

        if ($notalentCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $notalentCount,
                    'description' => trans('contact.talent.not_talent'), 
                    'icon'        => 'la-brain bg-success',
                    'url' => url($this->crud->getRoute() .'?talent=null'),
                ], 
            );
        }

        if ($noministryCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $noministryCount,
                    'description' => trans('contact.ministry.not_ministry'), 
                    'icon'        => 'la-dove bg-warning',
                    'url' => url($this->crud->getRoute() .'?ministry=null'),
                ], 
            );
        }

        Widget::add($widgets)->to('after_content');
    }
}
