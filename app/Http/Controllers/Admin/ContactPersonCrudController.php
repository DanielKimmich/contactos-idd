<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ContactRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use App\Http\Controllers\Admin\Operations\PrintOperation;
use App\Models\ContactPerson; 
use App\Models\ContactName;
//use App\Models\ContactPhone;
//use App\Models\ContactEmail;
//use App\Models\ContactAddress;
use App\Models\ContactEvent;
use App\Models\ContactBlood;
use App\Models\ContentType;
use App\Models\WorldCountry;
use App\Models\WorldCity;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactPersonCrudController extends CrudController
{
   use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

  //  use \App\Http\Controllers\Admin\Operations\PrintOperation;

//    protected $crudPhone;
//    protected $crudEmail;
//    protected $crudAddress;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContactPerson');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactperson');
        $this->crud->setEntityNameStrings(trans('contact.person.entity_name'), trans('contact.person.entity_names'));
//        $this->crud->with(['names', 'events']);
        $this->setAccessOperation('contactperson');
    //    $this->setContactPhone();
    //    $this->setContactEmail();
    //    $this->setContactAddress();

    // ------ CRUD DETAILS ROW
        $this->crud->enableDetailsRow();
        //$this->crud->disableDetailsRow();
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row_contact');

    //    $this->dashboard();

    }

    protected function setupListOperation()
    {   //$this->crud->setListContentClass('col-md-8 col-md-offset-2');
    //    $this->crud->setDefaultPageLength(25); //number of rows shown in list
     //   $this->crud->disableResponsiveTable();
      //  dump($this->crud->getRoute());
        $this->dashboard();
        $this->setupAvancedOperation();
     // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            'visibleInTable' => true,
        ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'display_name',
            'label' =>  trans('contact.person.display_name'),
            'type'  => 'text',
            'priority' => 1,
            'visibleInTable' => true,
        ]);
        $this->crud->addColumn([
            'name'  => 'sex_id',
            'label' => trans('contact.person.sex'),
            'type'  => 'select_from_array',
            'priority'  => 4,
            'options'   => ContentType::getTypeSexes(),
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]); 
         $this->crud->addColumn([
            'name'  => 'events.event_birth',
            'label' =>  trans('contact.event.birthday'),
            'type'  => 'text',
            'priority'  => 1,
            'visibleInTable' => false,
            'visibleInExport' => true,            
        ]); 
        $this->crud->addColumn([
            'name'  => 'events.age',
            'label' =>  trans('contact.event.age'),
            'type'  => 'text',
            'priority'  => 2,
            'wrapper' => [
                'element' => 'span',
                'class'   => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] >= '65') { return 'badge badge-warning'; }
                    if ($column['text'] >= '30') { return 'badge badge-info'; }
                    if ($column['text'] >= '13') { return 'badge badge-success'; }
                    return 'badge badge-default';
                },
            ],
            'visibleInExport' => true,
        ]);       
        $this->crud->addColumn([
            'name'  => 'civil_status',
            'label' => trans('contact.person.civil_status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeCivilStatus(),
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
         $this->crud->addColumn([
            'name'  => 'documents.document_number',
            'label' =>  trans('contact.document.number'),
            'type'  => 'text',
            'priority' => 4,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]); 
         $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.person.nationality'),
            'type'  => 'select_from_array',
            'priority'  => 4,
            'options'   => $this->getNations(),
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]); 
        $this->crud->addColumn([
            'name'      => 'phones', //the relationship in your Model
            'label'     => trans('contact.phone.titles'), //column heading
            'type'      => 'select_multiple',
            'priority'  => 3,
            'entity'    => 'phones', //the relationship in your Model
            'attribute' => 'data1', //foreign key attribute that is shown to user
            'separate'  => '/', //optional
            'visibleInExport' => true,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('phones', function ($q) use ($column, $searchTerm) {
                    $q->where('data1', 'like', '%'.$searchTerm.'%');
                });
            }
        ]); 
        $this->crud->addColumn([
            'name'  => 'phone_mobile',
            'label' => trans('contact.phone.mobile1'),
            'type'  => 'phone',
            'priority' => 3,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
        $this->crud->addColumn([
            'name'  => 'phone_home',
            'label' => trans('contact.phone.home1'),
            'type'  => 'phone',
            'priority' => 3,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
        $this->crud->addColumn([
            'name'  => 'email1',
            'label' => trans('contact.email.email1'),
            'type'  => 'email',
            'priority'  => 3,
            'limit'     => 80,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
        $this->crud->addColumn([
            'name'  => 'address1',
            'label' => trans('contact.address.address1'),
            'type'  => 'text',
            'priority'  => 3,
            'limit'     => 150,
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
        ]);
        $this->crud->addColumn([ //
            'name'  => 'bloods.data2',
            'label' => trans('contact.blood.type'),
            'type'  => 'select_from_array',
            'priority'  => 4, 
            'options' => ContentType::getTypeBloods(),
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]); 
        $this->crud->addColumn([ 
            'name'  => 'bloods.data1',
            'label' => trans('contact.blood.name'),
            'type'  => 'select_from_array',
            'priority'  => 4, 
            'options'     => ['YES' => 'Si', 'NO' => 'No', 'MAYBE' => 'Tal vez'],
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);      
        $this->crud->addColumn([
            'name'  => 'names.data14', 
            'label' => trans('contact.photo.tab'), 
            'type'  => 'check',
            'priority'  => 4,
            'visibleInExport' => true,
        ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.person.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeStatus(),
            'visibleInExport' => true,
        ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            'priority' => 4,
            'searchLogic' => false,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]); 
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
    //PHOTO
        $this->crud->addColumn([
            'name'  => 'names.data14',
            'label' => trans('contact.photo.profile_image'),
            'type'  => 'image',
         //   'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
          //  'disk' => config('backpack.base.root_disk_name'),
            'disk'   =>  Config::get('settings.contact_disk'), // 'dropbox',
            'height' => '150px',
            'width'  => '150px',
        ]);

        $this->crud->addColumn([
            'name'  => 'sex_id',
            'label' => trans('contact.person.sex'),
            'type'  => 'select_from_array',
            'options'   => ContentType::getTypeSexes(),
        ]);
        $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.person.nationality'),
            'type'  => 'select_from_array',
            'options'   => $this->getNations(),
        ]); 
        $this->crud->addColumn([
            'name'  => 'events.data1',
            'label' =>  trans('contact.event.birthday'),
            'type'  => 'text',
        ]);  
        $this->crud->addColumn([
            'name'  => 'events.age',
            'label' =>  trans('contact.event.age'),
            'type'  => 'text',
        ]);       
        $this->crud->addColumn([
            'name'  => 'civil_status',
            'label' => trans('contact.person.civil_status'),
            'type'  => 'select_from_array',
            'options'   => ContentType::getTypeCivilStatus(),
        ]);
        $this->crud->addColumn([
            'name'  => 'documents.data1',
            'label' =>  trans('contact.document.number'),
            'type'  => 'text',
            ]);  
 /*       $this->crud->addColumn([
            'name'      => 'phones', //the relationship in your Model
            'label'     => trans('contact.phone.titles'), //column heading
            'type'      => 'select_multiple',
         //   'type'      => 'relationship',
            'entity'    => 'phones', //the relationship in your Model
            'attribute' => 'phone_type_data', //foreign key attribute that is shown to user
            'limit'     => 80, // Limit the number of characters shown
        ]); */

        $this->crud->addColumn([
            'name' => 'phones', 
            'label' => trans('contact.phone.titles'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['phones'], true)); //converts json into array
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

/*        $this->crud->addColumn([
            'name'      => 'emails', //the relationship in your Model
            'label'     => trans('contact.email.titles'), //column heading
            'type'      => 'select_multiple',
            'entity'    => 'emails', //the relationship in your Model
            'attribute' => 'email_type_data', //foreign key attribute that is shown to user
            'limit'     => 80, // Limit the number of characters shown
        ]); */

        $this->crud->addColumn([
            'name' => 'emails', 
            'label' => trans('contact.email.titles'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['emails'], true)); //converts json into array
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

 /*       $this->crud->addColumn([
            'name'      => 'addresses', //the relationship in your Model
            'label'     => trans('contact.address.titles'), //column heading
            'type'      => 'select_multiple',
            'entity'    => 'addresses', //the relationship in your Model
            'attribute' => 'address_type_data', //foreign key attribute that is shown to user
            'limit'     => 150, // Limit the number of characters shown            
        ]);  */

        $this->crud->addColumn([
            'name' => 'addresses', 
            'label' => trans('contact.address.titles'), 
            'type' => 'closure', 
            'function' => function($entry) {
                $data = (json_decode($entry['addresses'], true)); //converts json into array
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

    //BLOOD
        $this->crud->addColumn([ // radio
            'name'  => 'bloods.data1',
            'label' => trans('contact.blood.name'),
            'type'  => 'select_from_array',
            //'type'  => 'radio',     //'radio',
            'options'     => ['YES' => 'Si', 'NO' => 'No', 'MAYBE' => 'Tal vez'],
        ]);      
        $this->crud->addColumn([ //
            'name'  => 'bloods.data2',
            'label' => trans('contact.blood.type'),
            'type'  => 'select_from_array',
            'options' => ContentType::getTypeBloods(),
        ]); 


        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.person.status'),
            'type'  => 'select_from_array',
            'options'   => ContentType::getTypeStatus(),
        ]);
    //INFO
        $this->getInfoColumns();
    }      


    protected function setupCreateOperation()
    {   //$this->crud->setCreateContentClass('col-md-8 col-md-offset-2');
        $this->crud->setValidation(ContactRequest::class);
        //$this->crud->disableAutoFocus();
// ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.person.display_name'),
            'type'  => 'text',
            'wrapper' => ['class' => 'form-group col-md-8'],
            'prefix'     => '<i class="la la-id-card-o"></i>',
            'attributes' => ['readonly' => 'readonly', 'id' => 'display_name'],
        ]);  
        $this->crud->addField([ // Text
            'name'  => 'status',
            'label' => trans('contact.person.status'),
            'type'  => 'select_from_array',
            'wrapper' => ['class' => 'form-group col-md-4'],
            'options'    => ContentType::getTypeStatus(),
            'default'    => 'START',
            'attributes' => ['id' => 'contact_status'],
        ]);
        $this->crud->addField([
            'name'  => 'update_fields',
            'type'  => 'update_fields_contact',
        ]);

    //NAME
        $this->crud->addField([
            'name'  => 'names.name_display',
            'type'  => 'hidden',
            'tab'   => trans('contact.name.tab'), 
            'attributes' => ['id' => 'name_display'],
        ]);
        $this->crud->addField([
            'name'  => 'names.name_first',
            'label' => trans('contact.name.first'),
            'type'  => 'text',
            'tab'   => trans('contact.name.tab'),
            'attributes' => ['id' => 'name_first'],
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
            'auto_focus' => 'true',
        ]);
        $this->crud->addField([
            'name'  => 'names.name_middle',
            'label' => trans('contact.name.middle'),
            'type'  => 'text',
            'tab'   =>  trans('contact.name.tab'),
            'attributes' => ['id' => 'name_middle'],
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing
        ]);
        $this->crud->addField([
            'name'  => 'names.name_family',
            'label' => trans('contact.name.family'),
            'type'  => 'text',
            'tab'   => trans('contact.name.tab'),
            'attributes' => ['id' => 'name_family'],
            'wrapper'   => ['class' => 'form-group col-md-8'], //resizing
        ]);
        $this->crud->addField([
            'name'  => 'names.name_suffix',
            'label' => trans('contact.name.suffix'),
            'type'  => 'text',
            'tab'   => trans('contact.name.tab'),
            'attributes' => ['id' => 'name_suffix'], 
            //'placeholder' => trans('contact.name.nickname')
            'wrapper'   => ['class' => 'form-group col-md-4'], //resizing
        //    'hint'      => trans('contact.name.nickname'),
        ]);
    //DATA
        $this->crud->addField([ // radio
            'name'  => 'sex_id',
            'label' => trans('contact.person.sex'),
            'type'  => 'radio',     //'radio',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'inline'      => true,      
            'options'     => ContentType::getTypeSexes(),
 //           'options'     => ['FEMALE' => 'Femenino', 'MALE' => 'Masculino'],
        ]);      
        $this->crud->addField([
            'name'  => 'events.event_birth',
            'label' => trans('contact.event.birthday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
        //    'entity' => 'events',
        ]);
        $this->crud->addField([        
            'name'  => 'events.event_type',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => trans('contact.data'),
        //    'entity' => 'events', 
            'value' => 'TYPE_BIRTHDAY',
        ], 'create');       
        $this->crud->addField([
            'name'  => 'documents.document_number',
            'label' => trans('contact.document.number'),            
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing    
        //    'entity' => 'documents',
        ]);

        $this->crud->addField([        
            'name'  => 'documents.document_type',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => trans('contact.data'),
        //    'entity' => 'documents', 
            'value' => 'TYPE_DOC',
        ], 'create'); 

        $this->crud->addField([ // Select
            'name'  => 'nationality_id',
            'label' => trans('contact.person.nationality'),
            'type'  => 'select2_from_array',
            'tab'   => trans('contact.data'), 
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing      
            'options'   => $this->getNations(),
            'default' => Config::get('settings.contact_nationality'),
            'allows_null' => true,
//            'type'  => 'select2',
//            'entity' => 'nationality', 
 //           'attribute' => 'name',
 //           'options'   => (function ($query) {
  //              return $query->orderBy('name', 'ASC')->pluck('name','code_alpha3')->get(); }),
        ]);

        $this->crud->addField([ // Text
            'name'  => 'civil_status',
            'label' => trans('contact.person.civil_status'),
            'type'  => 'select_from_array',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
            'options'    => ContentType::getTypeCivilStatus(),
            'allows_null' => true,
            'attributes' => ['id' => 'civil_status'],
        ]);
        $this->crud->addField([
            'name'  => 'events.event_dead',
            'label' => trans('contact.event.deadday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'attributes' => ['id' => 'event_dead'],
        //    'entity' => 'events',
        ]);
    //PHONE
        $this->crud->addField([
            'name'  => 'relation_phone',
            'label' => trans('contact.phone.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.phone.tab'),
        //    'fake' => true,
        //    'pivot' => true,
        //    'multiple' => false,
            // optional
            'new_item_label' => trans('contact.phone.add_new_item'), // customize text button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
          //  'min_rows' => 2, // minimum rows allowed, when reached the "delete" buttons will be hidden
         //   'max_rows' => 2, // maximum rows allowed, when reached the "new item" button will be hidden
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.phone.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypePhones(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.phone.number'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.phone.label'),
                    'type'  => 'text',
                ],
            ],
        ]);


    //EMAIL
        $this->crud->addField([
            'name'  => 'relation_email',
            'label' => trans('contact.email.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.email.tab'),
        //    'fake' => true,
            // optional
            'new_item_label' => trans('contact.email.add_new_item'), // customize text button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name'  => 'data2',
                    'label' => trans('contact.email.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeEmails(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data1',
                    'label' => trans('contact.email.address'),
                    'type'  => 'text',
                    'wrapper'   => ['class' => 'form-group col-md-6'],
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.email.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //ADDRESS
        $this->crud->addField([
            'name'  => 'relation_address',
            'label' => trans('contact.address.titles'),
            'type'  => 'repeatable',
            'tab'   => trans('contact.address.tab'),
        //    'fake' => true,
            // optional
            'new_item_label' => trans('contact.address.add_new_item'), // customize text button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'fields' => [
                [   'name' => 'id',
                    'type' => 'hidden',
                ],
                [   'name' => 'contact_id',
                    'type' => 'hidden',
                    'default'   =>  $this->crud->getCurrentEntryId(),
                ],        
                [   'name' => 'data1',
                    'label' => trans('contact.address.address'),
                    'type' => 'text',
                    'prefix'   => '<i class="la la-map-marker"></i>',
                    'attributes' => ['readonly' => 'readonly', 'id' => 'address_data1'],
                ],
                [   'name'  => 'data4',
                    'label' => trans('contact.address.street'),
                    'type'  => 'text',
                    'attributes' => ['id' => 'address_street'],
                ],
                [   'name' => 'data10',
                    'label' => trans('contact.address.country'),
                    'type' => 'select2_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attributes' => ['id' => 'address_country'],
                    'options'   => $this->getCountries(),
                    'default' => Config::get('settings.contact_country'),
                ],

                [   'name'  => 'data8',
                    'label' => trans('contact.address.division'),
                    'type'  => 'relationship',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                //    'attributes' => ['id' => 'address_division'],
                    'model' => 'App\Models\WorldDivision', // foreign key model
                    'entity'    => 'addresses',
                    'attribute' => 'name',
                    'ajax' => true,
                    'multiple' => false,
                 //   'data_source'  => backpack_url('contactperson/fetch/division'), // url to controller
                    'data_source'  => url($this->crud->route.'/fetch/division'),
                //    'placeholder' => '', // placeholder for the select
                    'dependencies'  => ['data10'], //this select2 is reset to null
                    'minimum_input_length' => 0, // minimum before querying results
                    'default' => Config::get('settings.contact_division'),
                  //  'include_all_form_fields'  => false,
                ],
                [   'name'  => 'data7',
                    'label' => trans('contact.address.city'),
                    'type'  => 'relationship',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                //    'attributes' => ['id' => 'address_city'],
                    'model' => 'App\Models\WorldCity', // foreign key model
                    'entity' => 'addresses', 
                    'attribute' => 'name',
                    'ajax' => true,
                    'multiple' => false,
                    'data_source'  => backpack_url('contactperson/fetch/city'), // url to controller search

           // 'placeholder' => '', // placeholder for the select
                    'dependencies'  => ['data10','data8'], //this select2 is reset to null
       //     'dependencies'  => ['contact_addresses[0][data8]'],
                    'minimum_input_length' => 0, // minimum before querying results
                    'default' => Config::get('settings.contact_city'),
                //    'include_all_form_fields'  => false,
                ],

                [   'name' => 'data9',
                    'label' => trans('contact.address.postcode'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'attributes' => ['id' => 'address_postcode'],
                ],                
                [   'name' => 'data6',
                    'label' => trans('contact.address.neigh'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attributes' => ['id' => 'address_neigh'], 
                ],                
                [   'name'  => 'data2',
                    'label' => trans('contact.address.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'options' => ContentType::getTypeAddresses(),
                    'allows_null' => true,
                ],
                [   'name'  => 'data3',
                    'label' => trans('contact.address.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    //BLOOD
        $this->crud->addField([ // radio
            'name'  => 'bloods.data1',
            'label' => trans('contact.blood.name'),
            'type'  => 'radio',     //'radio',
            'tab'   => trans('contact.blood.tab'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'inline'      => true,      
           // 'options'     => ContentType::getTypeSexes(),
            'options'     => ['YES' => 'Si', 'NO' => 'No', 'MAYBE' => 'Tal vez'],
        ]);      
        $this->crud->addField([ //
            'name'  => 'bloods.data2',
            'label' => trans('contact.blood.type'),
            'type'  => 'select_from_array',
            'tab'   => trans('contact.blood.tab'),
            'wrapper' => ['class' => 'form-group col-md-6'], 
            'options' => ContentType::getTypeBloods(),
            'allows_null' => true,
        ]); 
        $this->crud->addField([ //
            'name'  => 'bloods.data3',
            'label' => trans('contact.blood.label'),
            'type'  => 'text',
            'tab'   => trans('contact.blood.tab'),
        ]); 

    //PHOTO
        $this->crud->addField([
            'name' => 'names.data14',
            'label' => trans('contact.photo.profile_image'),
            'type' => 'image',
            'tab'   => trans('contact.photo.tab'),
      //      'max_file_size' => '10000',
        //    'entity' => 'names', 
          //  'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
          //  'disk' => config('backpack.base.root_disk_name'),
            'disk' =>  Config::get('settings.contact_disk'), //'dropbox', // in case you need to show images from a different disk
         //   'wrapper' => ['data-init-function' => 'ComprimirImageElement'],
    // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);

    //INFO
        $this->getInfoFields();

//dump($this->crud);
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('updated_at', 'desc');  // 'asc', 'desc'

    // ------ CRUD FILTERS
        // Birthday
        $this->crud->addFilter([
            'name'  => 'birthday',
            'label' => trans('contact.birthday'),
            'type'  => 'dropdown',
            ],
            $this->getMonth(),
            function ($value) { // if the filter is active
                if ($value === 'null') {
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($value) { $query->whereNull('data1');
                    });
                } else {
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($value) {
                    $query->whereNull('data4')->where(\DB::raw("substr(data1, 6, 2)"),$value)
                        ->orWhere(\DB::raw("substr(data1, 6,5)"),$value)->whereNull('data4');
                    });
                }
            });

        //Age Range
        $this->crud->addFilter([
            'name' => 'age',
            'label'=> trans('contact.age_range'),
            'type' => 'range',
            'label_from' => 'min',
            'label_to' => 'max',
            'attributes' => ['min' => 0, 'max' => 120],
            ],
            false,
            function($value) { // if the filter is active
                $range = json_decode($value);
                //$today = Carbon::today();
                if ($range->from) {
                    $datefrom = Carbon::today()->subYears($range->from)->format('Y-m-d');
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($datefrom) {
                        $query->whereNotNull('data1')->whereNull('data4')
                            ->where('data1', '<=', $datefrom);
                    });
                } 

                if ($range->to) {
                    $dateto = Carbon::today()->subYears($range->to)->format('Y-m-d');
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($dateto) {
                        $query->whereNotNull('data1')->whereNull('data4')
                            ->where('data1', '>=', $dateto);
                    });
                }
            });

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


// Grupo Sanguineo
        $this->crud->addFilter([ //
            'name'  => 'blood',
            'label' => trans('contact.blood.type'),
            'type'  => 'select2_multiple',
            ], 
            ContentType::getTypeBloods(),
            function ($values) { // if the filter is active
                if ($values === 'null') {
                //$users = User::doesntHave('posts')->get();
                    $this->crud->addClause('doesntHave', 'bloods');
                } else {
                    $this->crud->addClause('whereHas', 'bloods', function ($query) use ($values) {  $query->whereIn('data2', json_decode($values));
                    });
                }
            }); 
 
        // Estado Civil
        $this->crud->addFilter([
            'name' => 'civil_status',
            'label' => trans('contact.person.civil_status'),
            'type' => 'select2_multiple',      
            ], 
            function() {return ContentType::getTypeCivilStatus(); },
            function($values) { // if the filter is active
                if ($values === 'null') {
                    $this->crud->addClause('whereNull', 'civil_status');
                } else {
                     $this->crud->addClause('whereIn', 'civil_status', json_decode($values));
                    //foreach (json_decode($values) as $key => $value) {
                    //    $this->crud->addClause('orwhere', 'civil_status', $value);
                    //}
                }
            });

        // select2_multiple filter
        $this->crud->addFilter([
            'name' => 'status',
            'label' => trans('contact.person.status'),
            'type' => 'select2_multiple',      
            ], 
            function() {return ContentType::getTypeStatus(); },
            function($values) { // if the filter is active
                $this->crud->addClause('whereIn', 'status', json_decode($values));
                //foreach (json_decode($values) as $key => $value) {
                //    $this->crud->addClause('orwhere', 'status', $value);
                //}
            });

        // simple  photo
        $this->crud->addFilter([
            'name'  => 'photo',
            'label' => 'Foto',
            'type'  => 'simple_custom',
            ], 
            false, 
            function() { // if the filter is true
              $data = ($this->crud->getRequest()->query);
          //     dump($this->crud->getRoute());
           //     $tArray = array();
          //    foreach ($data as $key ) {
                  
              foreach ($data as $key => $value) {
                if ($key == 'photo' && $value == 'true') { 
                    $this->crud->addClause('whereHas', 'names', function ($query) { $query->whereNotNull('data14');
                    });
                } else if ($key == 'photo' && $value == 'false') {
                    $this->crud->addClause('whereHas', 'names', function ($query) { $query->whereNull('data14');
                    });
                }
              }
            } );

        // daterange filter
        $this->setFilterDateUpdate();

    }



    protected function setupUpdateOperation()
    {
        $this->crud->disableAutoFocus();
        $this->setupCreateOperation();
    }

//Operacion de Guardar
    public function store()
    { // do something before validation, before save, before everything;
        //dump($this->crud->getCurrentEntryId());
        //dump($this->crud->getRequest()->relation_phone);
        $data_phone = (json_decode($this->crud->getRequest()->relation_phone, true)); 
        $data_email = (json_decode($this->crud->getRequest()->relation_email, true)); 
        $data_address = (json_decode($this->crud->getRequest()->relation_address, true));
         // Remove fields not present on the user.
        $this->crud->setRequest($this->crud->getRequest()->request->remove('relation_phone'));
        $this->crud->setRequest($this->crud->getRequest()->request->remove('relation_email'));
        $this->crud->setRequest($this->crud->getRequest()->request->remove('relation_address'));
     //   dump($this->crud->getRequest());
        $response = $this->traitStore();
        // do something after save Parent, then save children
        //dump($this->crud->getCurrentEntryId());
        //$this->updateRelationFields();  

        foreach ($data_phone as &$item) {
            $item['contact_id'] = $this->crud->getCurrentEntryId();
        }
        //dump($data_phone);

        foreach ($data_email as &$item) {
            $item['contact_id'] = $this->crud->getCurrentEntryId();
        }
 
        foreach ($data_address as &$item) {
            $item['contact_id'] = $this->crud->getCurrentEntryId();
        }
        $this->crud->model->setRelationPhoneAttribute(json_encode($data_phone));
        $this->crud->model->setRelationEmailAttribute(json_encode($data_email));
        $this->crud->model->setRelationAddressAttribute(json_encode($data_address));
        return $response;
    }

//Operacion de Actualizar
    public function update()
    {
  //  $redirect_location = parent::updateCrud($request);
  //  $this->storeOrUpdateMacronutrients($request, $this->crud->entry);
  //  return $redirect_location; 

    // do something before validation, before save, before everything; for example:
    // $this->crud->request->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
    // $this->crud->request->request->remove('password_confirmation');
        // $this->crud->removeField('password_confirmation');

//dd($this->crud);
//   dd($this->crud->getCreateFields());
 //  dd($this->crud->getRelationFields());
//   dd($this->crud->getUpdateFields());
//dd($this->crud->request);

//dd($this->crud->validateRequest());

 //   dd($this->crud->getStrippedSaveRequest());


  //  dd($this->crud->getCurrentEntryId());
  //  dd($this->crud->model->findOrFail($this->crud->getCurrentEntryId()));
//  dd($this->crud->model->getCastedAttributes());

//     dump($this->crud->getRequest()->input('form'));
//dump($this->crud->getCurrentEntryId());
        $response = $this->traitUpdate();
        // do something after save
      //  dd($this->crud->entry); 

//dump($this->crud->getRequest()->relation_phone);

//dump($this->crud->getCurrentEntryId());

//$this->updateRelationFields(); 
 //       $this->crud->model->setRelationPhoneAttribute($this->crud->getRequest()->relation_phone);
 //       $this->crud->model->setRelationEmailAttribute($this->crud->getRequest()->relation_email);
  //      $this->crud->model->setRelationAddressAttribute($this->crud->getRequest()->relation_address);
     //   $this->updateDataFields(); 
      //   dd($response);
      //  dd($this->crud->entry); 
 //   dump($this->crud->getCurrentFields());
    return $response;
    }
/*
The solution I found was to override the update method:
Mutator is not called, the edit request finishes successfully
    public function update()
    {
        $request = $this->crud->validateRequest();
        $user = BackpackUser::find($request->id);
        $user->probation = $request->probation;
        $user->save();
        return $this->traitUpdate();
    }
*/
/*
    protected function updateDataFields()
    {
        $appendFields = [];
  //      $item = $this->crud->model->events->findOrFail($this->crud->entry->getKey());
        $fields = $this->crud->getCurrentFields();
        foreach($fields as $field){
            if($field['name'] === 'event_date'){
                array_set($appendFields, 'data2', $this->request->input('event_date'));
            }
            if($field['name'] === 'event_type'){
                array_set($appendFields, 'data3', $this->request->input('event_type'));
            }
        }
 //       dump($appendFields);
        $this->crud->model->events()->update($appendFields);
      //  $this->crud->model->events->save();
    }

*/

//public function destroy($id)
//{
   // $this->destroyMacronutrients($id);

//    $return = parent::destroy($id);

 //   return $return;
//}

/*
protected function storeOrUpdateMacronutrients(ContactRequest $request, Product $product)
{
    $macronutrients = Macronutrients::firstOrNew(['id' => $product->id]);

    $macronutrients->proteins   = $request->input('proteins');
    $macronutrients->fats       = $request->input('fats');
    $macronutrients->carbons    = $request->input('carbons');
    $macronutrients->calories   = $request->input('calories');

    $macronutrients->save();
}
*/
/*
protected function destroyMacronutrients($productId)
{
    $macronutrients = Macronutrients::findOrFail($productId);

    $macronutrients->delete();
}

    public function getClientPhones(ContactRequest $request, Contact $user)
    {
        if ($clientId = $request->input('client_id')) {
            $phones = $user->findOrFail($clientId)->phones;

            return view('renders.client_phones', compact('phones'));
        }

        return response()->json(['status' => 'error', 'messages' => [trans('phone.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Address $address
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*
    public function addClientPhone(ContactRequest $request, Contact $user, ContactData $phone)
    {
        if ($clientId = $request->input('phone')['client_id']) {
            $user = $user->findOrFail($clientId);

            $user->phones()->create($request->input('phone'));

            return response()->json(['status' => 'success']);

        }

        return response()->json(['status' => 'error', 'messages' => [trans('phone.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param Address $address
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*
    public function deleteClientPhone(ContactRequest $request, ContactData $phone)
    {
        if ($id = $request->input('id')) {
            $phone->findOrFail($id)->delete();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'messages' => [trans('phone.phone_id_is_required')]]);
    }
*/

    public function dashboard()
    {
        // display lead status counts on page top
        $widgets = [
            'type'  => 'div',
            'class' => 'row',
            'content' => [  ] // widgets
        ];  

        $personCount = ContactPerson::count();
        $nodatebirthCount = ContactEvent::where('data2', 'TYPE_BIRTHDAY')->whereNull('data1')->count();
        $nocivilstatusCount = ContactPerson::whereNull('civil_status')->count();
        $bloodCount = ContactBlood::count();
        $nobloodCount = ContactPerson::doesntHave('bloods')->count();
        $nophotoCount = ContactName::whereNull('data14')->count();

        if ($nodatebirthCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $nodatebirthCount,
                    'description' => trans('contact.event.not_birthday'), 
                    'icon'        => 'la-calendar-times bg-success',
                    'url' => url($this->crud->getRoute() .'?birthday=null'),
                ],
            );
        }
         
        if ($nocivilstatusCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $nocivilstatusCount,
                    'description' => trans('contact.person.not_civilstatus'), 
                    'icon'        => 'la-user bg-warning',
                    'url' => url($this->crud->getRoute() .'?civil_status=null'),
                ], 
            );
        }

        if ($nobloodCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $nobloodCount,
                    'description' => trans('contact.blood.not_blood'), 
                    'icon'        => 'la-heart bg-danger',
                    'url' => url($this->crud->getRoute() .'?blood=null'),
                ], 
            );
        }

        if ($nophotoCount > 0) { 
            array_push($widgets['content'], 
                [   'type'        => 'count',
                    'class'       => 'card mb-2',
                    'value'       => $nophotoCount,
                    'description' => trans('contact.photo.not_photo'), 
                    'icon'        => 'la-user-alt-slash bg-info',
                    'url' => url($this->crud->getRoute() .'?photo=false'),
                ], 
            );
        }

        Widget::add($widgets)->to('after_content');
    }

    public function getNations()
    {   
        $options = WorldCountry::orderBy('name')->pluck('name','code_alpha3');    
        return $options->toArray();
    }

    public function getCountries()
    {   
        $options = WorldCountry::all();
        $options = $options->sortBy('name')->pluck('name','id');
        return $options->toArray();
    }
/*
    protected function setContactPhone(): void
    {
        $this->crudPhone = new CrudPanel();
        $this->crudPhone->setModel(ContactPhone::class);
        $this->crudPhone->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crudPhone->setEntityNameStrings(trans('contact.phone.title'), trans('contact.phone.titles'));
        $this->crudPhone->addClause('where', 'contact_id', '=', $this->crud->getCurrentEntryId());
        $this->crudPhone->addClause('where', 'mimetype', '=', 'Phone');
    }

    protected function setContactEmail(): void
    {
        $this->crudEmail = new CrudPanel();
        $this->crudEmail->setModel(ContactEmail::class);
        $this->crudEmail->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crudEmail->setEntityNameStrings(trans('contact.email.title'), trans('contact.email.titles'));
        $this->crudEmail->addClause('where', 'contact_id', '=', $this->crud->getCurrentEntryId());
        $this->crudEmail->addClause('where', 'mimetype', '=', 'Email');
    }

    protected function setContactAddress(): void
    {
        $this->crudAddress = new CrudPanel();
        $this->crudAddress->setModel(ContactAddress::class);
        $this->crudAddress->setRoute(config('backpack.base.route_prefix') . '/contactdata');
        $this->crudAddress->setEntityNameStrings(trans('contact.address.title'), trans('contact.address.titles'));
        $this->crudAddress->addClause('where', 'contact_id', '=', $this->crud->getCurrentEntryId());
        $this->crudAddress->addClause('where', 'mimetype', '=', 'Address');
    }

*/

    public function renameKey($oldkey, $newkey, $array) {
        $val = $array[$oldkey]; 
        $tmp_A = array_flip($array); 
        $tmp_A[$val] = $newkey; 
        return array_flip($tmp_A); 
    } 
    
    public function getMonth()
    {
        $today      = Carbon::today()->format("m-d");
        $yesterday  = Carbon::yesterday()->format('m-d');
        $tomorrow   = Carbon::tomorrow()->format('m-d');
        $months = [
            $today      => 'Hoy',
            $yesterday  => 'Ayer',
            $tomorrow   => 'Mañana',
            '01'  => 'Enero',
            '02'  => 'Febrero',
            '03'  => 'Marzo',
            '04'  => 'Abril',
            '05'  => 'Mayo',
            '06'  => 'Junio',
            '07'  => 'Julio',
            '08'  => 'Agosto',
            '09'  => 'Septiembre',
            '10'  => 'Octubre',
            '11'  => 'Noviembre',
            '12'  => 'Diciembre',
         //   'null' => 'sin fecha',
        ];
        return $months;
    }

    public function fetchDivision()
    {
        //dump($this->crud->getRequest()->input('form'));
        return $this->fetch('App\Models\WorldDivision');
    /*     return $this->fetch([
            'model' => 'App\Models\WorldDivision', // required
            'searchable_attributes' => ['name'],
            'paginate' => 50, // items to show per page
           'query' => function($model) {
                $form = $this->crud->getRequest()->input('form');
                foreach ($form as $entry) {
                    if ($entry['name'] == 'country_id') {
                        $country_id = (int) $entry['value'];
                        break 1;  // Sólo sale del foreach. 
                    }
                }
                return $model->where('country_id', $country_id)->orderBy('name');
            } // to filter the results that are returned
        
        ]); */
    }

    public function fetchCity()
    {
     //   return $this->fetch('App\Models\WorldCity');
        return $this->fetch([
            'model' => 'App\Models\WorldCity', // required
            'searchable_attributes' => ['name'],
            'paginate' => 50, // items to show per page
     /*       'query' => function($model) {
                $form = $this->crud->getRequest()->input('form');
                foreach ($form as $entry) {
                    if ($entry['name'] == 'country_id') {
                        $country_id = (int) $entry['value'];
                        break 1;  // Sólo sale del foreach. 
                    }
                }
                return $model->where('country_id', $country_id)->orderBy('name');
            } // to filter the results that are returned
        */
        ]); 

    }
   
    protected function setupInlineCreateOperation()
    {

        // remove a field from both operations
    //    $this->crud->removeField('contact_phones');
    //    $this->crud->removeField('contact_emails');
    //    $this->crud->removeField('contact_addresses');
        $this->crud->removeField('relation_phone');
        $this->crud->removeField('relation_email');
        $this->crud->removeField('relation_address');
        $this->crud->removeField('names[data14]');
        $this->crud->removeField('bloods[data1]');
        $this->crud->removeField('bloods[data2]');
        $this->crud->removeField('bloods[data3]');
    }

}

/*
 
//            'key'   => 'names.mimetype',
//            'attributes' => ['id' => 'namesmimetype'],
  //          'fake'  => true, // show the field, but don’t store 
   //         'store_in' => 'mimetype', // [optional] 
 //           'model' => 'App\Models\ContactName',   

                [
                'label'=>'Contacts Business', 
                'name'=>'contacts', 
                'attribute'=>'name',
                'type'=>'select_multiple_callback',
                'entity'=>'contactsbusiness', 
                'type_contact_id' => '1', 
                'model' => "App\Models\Contact", 
                'pivot' => true,
                
            
            ],
            [
                'label'=>'Contacts IS+T', 'name'=>'contacts2', 'attribute'=>'name','type'=>'select_multiple_callback','entity'=>'contactsist', 'type_contact_id' => '2', 'model' => "App\Models\Contact", 'pivot' => true,
                
            
            ],

            public function contactsbusiness() { return $this->belongsToMany('App\Models\Contact','applications_contacts') ->withPivot('application_id','contact_id') ->where('type_contact_id', 1) ->using(ContactPivot::class); } 
            public function contactsist() { return $this->belongsToMany('App\Models\Contact','applications_contacts') ->withPivot('application_id','contact_id') ->where('type_contact_id', 2) ->using(ContactPivot::class); }


// $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
            */