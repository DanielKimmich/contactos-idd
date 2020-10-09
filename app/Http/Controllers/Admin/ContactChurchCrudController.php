<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactChurchRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ContentType;

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
            'name'  => 'sex_id',
            'label' => trans('contact.person.sex'),
            'type'  => 'select_from_array',
            'priority'  => 4,
            'options'   => ContentType::getTypeSexes(),
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContactChurchRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

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
                [   'name'  => 'data1',
                    'label' => trans('contact.gift.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.gift.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeStatus(), //ContentType::getTypeGifts(),
                    'allows_null' => true,
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
                [   'name'  => 'data1',
                    'label' => trans('contact.talent.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.talent.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeStatus(), //ContentType::getTypeTalents(),
                    'allows_null' => true,
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
                [   'name'  => 'data1',
                    'label' => trans('contact.ministry.name'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.ministry.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeStatus(), //ContentType::getTypeMinistries(),
                    'allows_null' => true,
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
}
