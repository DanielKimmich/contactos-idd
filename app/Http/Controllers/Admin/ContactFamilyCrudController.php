<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FamilyRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use App\Models\ContentType;
use App\Models\ContactFamily;
use App\Models\ContactRelation; 

/**
 * Class FamilyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactFamilyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContactFamily');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactfamily');
        $this->crud->setEntityNameStrings(trans('contact.family.entity_name'), trans('contact.family.entity_names'));
        $this->setAccessOperation('contactfamily');
    }


    protected function setupListOperation()
    {
        $this->setupAvancedOperation();
        $this->dashboard(); 
        $this->addCustomButton();

     // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'display_name',
            'label' =>  trans('contact.family.display_name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'parents',
            'label' => trans('contact.parent.tab'),
            'type'  => 'relationship_count',
            'priority'  => 2,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'spouses',
            'label' => trans('contact.spouse.tab'),
            'type'  => 'relationship_count',
            'priority'  => 2,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'children',
            'label' => trans('contact.children.tab'),
            'type'  => 'relationship_count',
            'priority'  => 2,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'relatives',
            'label' => trans('contact.relative.tab'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'others',
            'label' => trans('contact.other.tab'),
            'type'  => 'relationship_count',
            'priority'  => 3,
            'suffix' => '',
            ]); 
        $this->crud->addColumn([
            'name'  => 'civil_status',
            'label' => trans('contact.family.civil_status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeCivilStatus(),
            ]);
    }

    protected function setupShowOperation()
    {  // $this->crud->setShowContentClass('col-md-8 col-md-offset-2');
        $this->crud->set('show.setFromDb', false);
        $this->addCustomButton();

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
            'name' => 'relation_parent', 
            'label' => trans('contact.parent.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_parent'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['name'];
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
            'name' => 'relation_spouse', 
            'label' => trans('contact.spouse.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_spouse'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['name'];
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
            'name' => 'relation_children', 
            'label' => trans('contact.children.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_children'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['name'];
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
            'name' => 'relation_relative', 
            'label' => trans('contact.relative.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_relative'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['name'];
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
            'name' => 'relation_other', 
            'label' => trans('contact.other.tab'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['relation_other'], true)); //converts json into array
                $items = '';
                if(is_array($data)) {
                    foreach ($data as $item) {
                        $items .= '<b>'. $item['label'] .':</b> '. $item['name'];
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

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FamilyRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
     //   $this->setupCreateOperation();
        $this->crud->setValidation(FamilyRequest::class);
        // ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.family.display_name'),
            'type'  => 'text',
            'wrapper'   => ['class' => 'form-group col-md-8'],
            'prefix'    => '<i class="la la-id-card-o"></i>',
            'attributes' => ['readonly' => 'readonly'],
            ]);
        $this->crud->addField([ // Text
            'name'  => 'civil_status',
            'label' => trans('contact.family.civil_status'),
            'type'  => 'select_from_array',
            'wrapper'   => ['class' => 'form-group col-md-4'],
            'options'   => ContentType::getTypeCivilStatus(),
            ]);        
    if (auth()->user()->can('contactperson.create') ) {
    //PARENT
         $this->crud->addField([
            'name'  => 'relation_parent',
            'label' => trans('contact.parent.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.parent.tab'),
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.parent.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationParents(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.parent.name'),
                    'type'  => 'relationship',
                    'wrapper'   => ['class' => 'form-group col-md-8'],           
                    'entity'    => 'parents',
                    'data_source' => url($this->crud->route.'/fetch/person'),
                    'attribute' => 'display_name',
                    'model'     => 'App\Models\ContactPerson',
                    'ajax' => false,
                    'multiple' => false,
                    'allows_null' => true,
                    'inline_create' => [
                        'entity' => 'contactperson', 
                        'modal_class' => 'modal-dialog modal-xl',
                    ],             
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.parent.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //SPOUSE
         $this->crud->addField([
            'name'  => 'relation_spouse',
            'label' => trans('contact.spouse.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.spouse.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.spouse.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationSpouses(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.spouse.name'),
                    'type'  => 'relationship',
                    'wrapper'   => ['class' => 'form-group col-md-8'],           
                    'entity'    => 'spouses',
                    'data_source' => url($this->crud->route.'/fetch/person'),
                    'attribute' => 'display_name',
                    'model'     => 'App\Models\ContactPerson',
                    'ajax' => false,
                    'multiple' => false,
                    'allows_null' => true,
                    'inline_create' => [
                        'entity' => 'contactperson', 
                        'modal_class' => 'modal-dialog modal-xl',
                    ],             
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.spouse.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //CHILDREN
         $this->crud->addField([
            'name' => 'relation_children',
            'label' => trans('contact.children.data'),
            'type' => 'repeatable',
            'tab' => trans('contact.children.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.children.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationChildren(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.children.name'),
                    'type'  => 'relationship',
                    'wrapper'   => ['class' => 'form-group col-md-8'],           
                    'entity'    => 'children',
                    'data_source' => url($this->crud->route.'/fetch/person'),
                    'attribute' => 'display_name',
                    'model'     => 'App\Models\ContactPerson',
                    'ajax' => false,
                    'multiple' => false,
                    'allows_null' => true,
                    'inline_create' => [
                        'entity' => 'contactperson', 
                        'modal_class' => 'modal-dialog modal-xl',
                    ],             
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.children.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //RELATIVE
         $this->crud->addField([
            'name'  => 'relation_relative',
            'label' => trans('contact.relative.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.relative.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.relative.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationRelatives(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.relative.name'),
                    'type'  => 'relationship',
                    'wrapper'   => ['class' => 'form-group col-md-8'],           
                    'entity'    => 'relatives',
                    'data_source' => url($this->crud->route.'/fetch/person'),
                    'attribute' => 'display_name',
                    'model'     => 'App\Models\ContactPerson',
         //           'options'   => (function ($query) {
          //              return $query->orderBy('display_name', 'ASC')->get(); }), 
                    'ajax' => false,
                    'multiple' => false,
                    'allows_null' => true,
                    'inline_create' => [
                        'entity' => 'contactperson', 
                        'modal_class' => 'modal-dialog modal-xl',
                    ],             
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.relative.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //OTHER
         $this->crud->addField([
            'name'  => 'relation_other',
            'label' => trans('contact.other.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.other.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.other.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationOthers(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.other.name'),
                    'type'  => 'relationship',
                    'wrapper'   => ['class' => 'form-group col-md-8'],           
                    'entity'    => 'others',
                    'data_source' => url($this->crud->route.'/fetch/person'),
                    'attribute' => 'display_name',
                    'model'     => 'App\Models\ContactPerson',
                    'ajax' => false,
                    'multiple' => false,
                    'allows_null' => true,
                    'inline_create' => [
                        'entity' => 'contactperson', 
                        'modal_class' => 'modal-dialog modal-xl',
                    ],             
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.other.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    } else {    
    //PARENT
         $this->crud->addField([
            'name'  => 'relation_parent',
            'label' => trans('contact.parent.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.parent.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.parent.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationParents(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.parent.name'),
                    'type'  => 'select2',
                    'wrapper'   => ['class' => 'form-group col-md-8'],
                    'entity'    => 'parents',
                    'model'     => 'App\Models\ContactPerson',
                    'attribute' => 'display_name',
                    'allows_null' => true,
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.parent.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //SPOUSE
         $this->crud->addField([
            'name'  => 'relation_spouse',
            'label' => trans('contact.spouse.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.spouse.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.spouse.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationSpouses(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.spouse.name'),
                    'type'  => 'select2',
                    'wrapper'   => ['class' => 'form-group col-md-8'],
                    'entity'    => 'spouses',
                    'model'     => 'App\Models\ContactPerson',
                    'attribute' => 'display_name',
                    'allows_null' => true,
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.spouse.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //CHILDREN
         $this->crud->addField([
            'name' => 'relation_children',
            'label' => trans('contact.children.data'),
            'type' => 'repeatable',
            'tab' => trans('contact.children.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.children.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationChildren(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.children.name'),
                    'type'  => 'select2',
                    'wrapper'   => ['class' => 'form-group col-md-8'],
                    'entity'    => 'children',   // 'children.person',
                    'model'     => 'App\Models\ContactPerson',
                    'attribute' => 'display_name',
                    'allows_null' => true,
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.children.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //RELATIVE
         $this->crud->addField([
            'name'  => 'relation_relative',
            'label' => trans('contact.relative.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.relative.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.relative.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationRelatives(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.relative.name'),
                    'type'  => 'select2',
                    'wrapper'   => ['class' => 'form-group col-md-8'],
                    'entity'    => 'relatives',   // 'children.person',
                    'model'     => 'App\Models\ContactPerson',
                    'attribute' => 'display_name',
                    'allows_null' => true,
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.relative.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //OTHER

         $this->crud->addField([
            'name'  => 'relation_other',
            'label' => trans('contact.other.data'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.other.tab'),
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.other.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationOthers(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.other.name'),
                    'type'  => 'select2',
                    'wrapper'   => ['class' => 'form-group col-md-8'],
                    'entity'    => 'others', 
                    'model'     => 'App\Models\ContactPerson',
                    'attribute' => 'display_name',
                    'allows_null' => true,
                ],    
                [   'name'  => 'data3',
                    'label' => trans('contact.other.label'),
                    'type'  => 'text',
                ],
            ],
        ]);
    }
    //INFO
        $this->getInfoFields();
    }

    public function fetchPerson()
    {
        return $this->fetch('App\Models\ContactPerson');
    }

    public function getPersons()
    {   
        $options = ContactPerson::orderBy('display_name')->pluck('display_name','id'); 
        return $options->toArray();
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

        // Estado Civil
        $this->crud->addFilter([
            'name' => 'civil_status',
            'label' => trans('contact.person.civil_status'),
            'type' => 'select2_multiple',      
            ], 
            function() {return ContentType::getTypeCivilStatus(); },
            function($values) { // if the filter is active
                $this->crud->addClause('whereIn', 'civil_status', json_decode($values));
            });

        // Family Group
        $this->crud->addFilter([
            'name'  => 'family',
            'label' => trans('contact.family.family_group'),
            'type'  => 'dropdown',
            ],
            function() {return ContentType::getTypeFamilyRelations(); },
            function ($value) { // if the filter is active
            /*    if ($value === 'null') {
                    $this->crud->addClause('doesntHave', 'relations');
                } else {
                    $this->crud->addClause('whereHas', 'relations', function ($query) use ($value) {
                    $query->where('data2', $value);
                    });
                }
*/
                switch ($value) {
                    case 'null':
                        $this->crud->addClause('doesntHave', 'relations');
                        break;
                    case 'TYPE_PARENT':
                        $this->crud->addClause('whereHas', 'parents');
                        break;
                    case 'TYPE_SPOUSE':
                        $this->crud->addClause('whereHas', 'spouses');
                        break;
                    case 'TYPE_CHILDREN':
                        $this->crud->addClause('whereHas', 'children');
                        break;
                    case 'TYPE_RELATIVE':
                        $this->crud->addClause('whereHas', 'relatives');
                        break;
                    case 'TYPE_OTHERS':
                        $this->crud->addClause('whereHas', 'others');
                        break;
                }
            });

        // daterange filter
        $this->setFilterDateUpdate();
    }

    public function addCustomButton()
    {   // ----BUTTONS
        if (auth()->user()->can('contactperson.update') ) {
            $this->crud->allowAccess('updateperson');
            $this->crud->addButtonFromView('line', 'updateperson', 'updatePerson', 'end');
            $this->crud->moveButton('updatefamily', 'before','delete');
        }
        if (auth()->user()->can('contactchurch.update') ) {    
            $this->crud->allowAccess('updatechurch');
            $this->crud->addButtonFromView('line', 'updatechurch', 'updateChurch', 'end'); 
            $this->crud->moveButton('updatechurch', 'before','delete');         
        }     

        //    $this->crud->addButtonFromView('line', 'topdf', 'topdf', 'end');   
    }


    public function dashboard()
    {
        // display lead status counts on page top
        $widgets = [
            'type'  => 'div',
            'class' => 'row',
            'content' => [  ] // widgets
        ];  

 //       $personCount = ContactFamily::count();
 //       $relationCount = ContactRelation::select('contact_id')->groupBy('contact_id')->get()->count();
        $norelationCount = ContactFamily::doesntHave('relations')->count();

        if ( $norelationCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       =>  $norelationCount,
                    'description' => trans('contact.family.not_family'), 
                    'icon'        => 'la-user bg-success',
                    'url'         => url($this->crud->getRoute() .'?family=null'),
                ],
            );
        }

        Widget::add($widgets)->to('after_content');
    }

}
