<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ContactRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use App\Http\Controllers\Admin\Operations\PrintOperation;
use App\Models\Contact;
use App\Models\ContactData;
use App\Models\ContactPhone;
use App\Models\ContactEmail;
use App\Models\ContactAddress;
use App\Models\ContentType;
use App\Models\WorldCountry;
use App\Models\WorldCity;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  //  use \App\Http\Controllers\Admin\Operations\PrintOperation;

    protected $crudPhone;
    protected $crudEmail;
    protected $crudAddress;

    public function setup()
    {
        $this->crud->setModel('App\Models\Contact');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contact');
        $this->crud->setEntityNameStrings(trans('contact.title'), trans('contact.titles'));
//        $this->crud->with(['names', 'events']);
        $this->setupAvancedOperation();
        $this->setAccessOperation('contactdata');
        $this->setContactPhone();
        $this->setContactEmail();
        $this->setContactAddress();

    // ------ CRUD DETAILS ROW
        $this->crud->enableDetailsRow();
        //$this->crud->disableDetailsRow();
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row_contact');

    }

    protected function setupListOperation()
    {   //$this->crud->setListContentClass('col-md-8 col-md-offset-2');
    //    $this->crud->setDefaultPageLength(25); //number of rows shown in list
     //   $this->crud->disableResponsiveTable();
     // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'display_name',
            'label' =>  trans('contact.display_name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'sex_id',
            'label' => trans('contact.sex'),
            'type'  => 'select_from_array',
            'priority'  => 4,
            'options'   => ContentType::getTypeSexes(),
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
            ]); 
         $this->crud->addColumn([
            'name'  => 'events.event_birth',
            'label' =>  trans('contact.event.birthday'),
            'type'  => 'text',
            'priority'  => 1,
            ]); 
 /*        $this->crud->addColumn([
            'name'  => 'events.birthday',
            'label' =>  'birthday',
            'type'  => 'array',
            'priority'  => 1,
//           'orderable' => true,            
            ]);     */
        $this->crud->addColumn([
            'name'  => 'events.age',
            'label' =>  trans('contact.event.age'),
            'type'  => 'text',
            'priority'  => 2,
//            'orderable' => true,
            ]);       
        $this->crud->addColumn([
            'name'  => 'civil_status',
            'label' => trans('contact.civil_status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeCivilStatus(),
            ]);
         $this->crud->addColumn([
            'name'  => 'documents.document_number',
            'label' =>  trans('contact.document.number'),
            'type'  => 'text',
            'priority' => 4,
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
            ]); 
         $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select',
            'priority'  => 4,
            'entity'    => 'nationality', 
            'attribute' => 'name',
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
            ]); 

        $this->crud->addColumn([
            'name'  => 'phone_mobile',
            'label' => trans('contact.phone.mobile1'),
            'type'  => 'phone',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'phone_home',
            'label' => trans('contact.phone.home1'),
            'type'  => 'phone',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name'  => 'email1',
            'label' => trans('contact.email.email1'),
            'type'  => 'email',
            'priority'  => 3,
            'limit'     => 100,
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
            ]);
        $this->crud->addColumn([
            'name'  => 'address1',
            'label' => trans('contact.address.address1'),
            'type'  => 'text',
            'priority'  => 3,
            'limit'     => 150,
            'exportOnlyField' => true,  //forced to exportfield and hidden in table
            ]);
        $this->crud->addColumn([
            'name'  => 'names.data14', 
            'label' => trans('contact.photos'), 
            'type'  => 'check',
            'priority'  => 4,
            ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeStatus(),
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            'priority' => 4,
            ]); 
/*        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Created At',
            'type' => 'closure',
            'priority' => 2,
            'function' => function($entry) {
                return 'Created on '.$entry->created_at;
                }
            ]); */
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
            'label' =>  trans('contact.display_name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'sex_id',
            'label' => trans('contact.sex'),
            'type'  => 'select_from_array',
            'options'   => ContentType::getTypeSexes(),
            ]);
        $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select',
            'entity' => 'nationality', 
            'attribute' => 'name',
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
            'name'  => 'documents.data1',
            'label' =>  trans('contact.document.number'),
            'type'  => 'text',
            ]);  
 /*      $this->crud->addColumn([
            'name' => 'phones',
            'label' => 'Table',
            'type' => 'table',
            'columns' => [
                'name'  => 'data1',
                'desc'  => 'data2',
                'price' => 'data3',
            ]
        ]); */

        $this->crud->addColumn([
            'name'      => 'phones', //the relationship in your Model
            'label'     => trans('contact.phone.titles'), //column heading
            'type'      => 'select_multiple',
            'entity'    => 'phones', //the relationship in your Model
            'attribute' => 'data1', //foreign key attribute that is shown to user
            ]); 
        $this->crud->addColumn([
            'name'      => 'emails', //the relationship in your Model
            'label'     => trans('contact.email.titles'), //column heading
            'type'      => 'select_multiple',
            'entity'    => 'emails', //the relationship in your Model
            'attribute' => 'data1', //foreign key attribute that is shown to user
            ]);
        $this->crud->addColumn([
            'name'      => 'addresses', //the relationship in your Model
            'label'     => trans('contact.address.titles'), //column heading
            'type'      => 'select_multiple',
            'entity'    => 'addresses', //the relationship in your Model
            'attribute' => 'data1', //foreign key attribute that is shown to user
            ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'select_from_array',
            'options'   => ContentType::getTypeStatus(),
            ]);
        $this->crud->addColumn([    
            'name'  => 'created_at',
            'label' => trans('contact.created_at'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            ]); 
        $this->crud->addColumn([    
            'name'  => 'created_by_user',
            'label' => trans('contact.created_by'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_by_user',
            'label' => trans('contact.updated_by'),
            'type'  => 'text',
            ]); 

    }      


    protected function setupCreateOperation()
    {   //$this->crud->setCreateContentClass('col-md-8 col-md-offset-2');
        $this->crud->setValidation(ContactRequest::class);
        //$this->crud->disableAutoFocus();
// ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.display_name'),
            'type'  => 'text',
            'wrapper' => ['class' => 'form-group col-md-8'],
            'prefix'     => '<i class="la la-id-card-o"></i>',
            'attributes' => ['id' => 'display_name', 'readonly' => 'readonly'],
            ]);  
        $this->crud->addField([ // Text
            'name'  => 'status',
            'label' => trans('contact.status'),
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
            'name'  => 'name_display',
            'type'  => 'hidden',
            'tab'   => trans('contact.names'), 
            'attributes' => ['id' => 'name_display'],
            'entity' => 'names', 
            ]);
        $this->crud->addField([
            'name'  => 'name_first',
            'label' => trans('contact.name.first'),
            'type'  => 'text',
            'tab'   => trans('contact.names'),
            'attributes' => ['id' => 'name_first'],
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'entity' => 'names', 
            'auto_focus' => 'true',
            ]);
        $this->crud->addField([
            'name'  => 'name_middle',
            'label' => trans('contact.name.middle'),
            'type'  => 'text',
            'tab'   =>  trans('contact.names'),
            'attributes' => ['id' => 'name_middle'],
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'entity' => 'names', 
            ]);

        $this->crud->addField([
            'name'  => 'name_family',
            'label' => trans('contact.name.family'),
            'type'  => 'text',
            'attributes' => ['id' => 'name_family'],
            'tab'    => trans('contact.names'),
            'entity' => 'names', 
            ]);

    //DATA
        $this->crud->addField([ // radio
            'name'  => 'sex_id',
            'label' => trans('contact.sex'),
            'type'  => 'radio',     //'radio',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'inline'      => true,      
            'options'     => ContentType::getTypeSexes(),
//            'options'     => $this->getTypeSexes(),
 //           'options'     => ['FEMALE' => 'Femenino', 'MALE' => 'Masculino'],
           ]);      
        $this->crud->addField([
            'name'  => 'event_birth',
            'label' => trans('contact.event.birthday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-3'], //resizing
            'entity' => 'events',
            ]);
        $this->crud->addField([
            'name'  => 'event_dead',
            'label' => trans('contact.event.deadday'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-3'], //resizing
            'attributes' => ['id' => 'event_dead'],
            'entity' => 'events',
            ]);
        $this->crud->addField([        
            'name'  => 'event_type',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => trans('contact.data'),
            'entity' => 'events', 
            'value' => 'TYPE_BIRTHDAY',
            ], 'create');       

        $this->crud->addField([
            'name'  => 'document_number',
            'label' => trans('contact.document.number'),            
            'type'  => 'text',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing    
            'entity' => 'documents',
            ]);

        $this->crud->addField([        
            'name'  => 'document_type',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => trans('contact.data'),
            'entity' => 'documents', 
            'value' => 'TYPE_DOC',
            ], 'create'); 

        $this->crud->addField([ // Text
            'name'  => 'civil_status',
            'label' => trans('contact.civil_status'),
            'type'  => 'select_from_array',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-4'],
            'options'    => ContentType::getTypeCivilStatus(),
            'allows_null' => true,
            ]);

/*
        $this->crud->addField([ // Select
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
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
*/
    //PHONE
        $this->crud->addField([
            'name' => 'contact_phones',
            'label' => trans('contact.phone.titles'),
            'type' => 'relationFields',
            'tab' => trans('contact.phones'),
            'foreignKey' => 'contact_id',
           // 'crud' => $this->crud->model->phones,
          //'crud' => new crudPanel(ContactDataCrudController::class),
            'crud' => $this->crudPhone,
            'fake' => true,
            'additional_fields_count' => 3,
            'fields' => [
                [   'name' => 'contact_id',
                    'label' => 'contact_id',
                    'type' => 'hidden',
                ],
                [   'name' => 'data1',
                    'label' => trans('contact.phone.number'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'entity' => 'phones',
                ],
                [   'name' => 'data2',
                    'label' => trans('contact.phone.type'),
                    'type' => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'phones',
                    'options'     => ContentType::getTypePhones(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.phone.label'),
                    'type' => 'text',
                //    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'phones',
                ],
            ],
        ], 'both');

    //EMAIL
        $this->crud->addField([
            'name' => 'contact_emails',
            'label' => trans('contact.email.titles'),
            'type' => 'relationFields',
            'tab' => trans('contact.emails'),
            'foreignKey' => 'contact_id',
            'crud' => $this->crudEmail,
            'fake' => true,
            'additional_fields_count' => 3,
            'fields' => [
                [   'name' => 'contact_id',
                    'label' => 'contact_id',
                    'type' => 'hidden',
                ],
                [   'name' => 'data1',
                    'label' => trans('contact.email.address'),
                    'type' => 'email',
                    'entity' => 'emails',
                ],
                [   'name' => 'data2',
                    'label' => trans('contact.email.type'),
                    'type' => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'entity' => 'emails',
                    'options'     => ContentType::getTypeEmails(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.email.label'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'emails',
                ],
 /*               [   'name' => 'data4',
                    'label' => trans('contact.email.display_name'),
                    'type' => 'text',
                    'entity' => 'emails',
                ],         */       
            ],
        ], 'both');

    //ADDRESS
        $this->crud->addField([
            'name' => 'contact_addresses',
            'label' => trans('contact.address.titles'),
            'type' => 'relationFields',
            'tab' => trans('contact.addresses'),
            'foreignKey' => 'contact_id',
            'crud' => $this->crudAddress,
            'fake' => true,
            'additional_fields_count' => 3,
            'fields' => [
                [   'name' => 'contact_id',
                    'label' => 'contact_id',
                    'type' => 'hidden',
                ],
                [   'name' => 'data1',
                    'label' => trans('contact.address.address'),
                    'type' => 'text',
                    'prefix'   => '<i class="la la-map-marker"></i>',
                    'attributes' => ['readonly' => 'readonly'],
                    'entity' => 'addresses',
                ],
                [   'name' => 'data2',
                    'label' => trans('contact.address.type'),
                    'type' => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'addresses',
                    'options'     => ContentType::getTypeAddresses(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.address.label'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'addresses',
                ],
                [   'name' => 'data4',
                    'label' => trans('contact.address.street'),
                    'type' => 'text',
                    'entity' => 'addresses',
                ],  
                [   'name' => 'data10',
                    'label' => trans('contact.address.country'),
                    'type' => 'select2_from_array',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                    'options'   => $this->getCountries(),
                    'default' => Config::get('settings.contact_country'),
                ],
            [
            'name'  => 'data8',
            'label' => trans('contact.address.division'),
            'type'  => 'select2_from_ajax',
            'wrapper' => ['class' => 'form-group col-md-6'],
            'entity' => 'addresses', 
            'attribute' => 'name',
            'model' => 'App\Models\WorldDivision', // foreign key model
            'data_source'  => url('admin/searchdivision/data10'), // url to controller search
            'placeholder' => '', // placeholder for the select
      //      'dependencies'  => ['data10'], //this select2 is reset to null
            'minimum_input_length' => 0, // minimum before querying results
            'default' => Config::get('settings.contact_division'),
            ],
            [
            'name'  => 'data7',
            'label' => trans('contact.address.city'),
            'type'  => 'select2_from_ajax',
            'wrapper' => ['class' => 'form-group col-md-6'],
            'entity' => 'addresses', 
            'attribute' => 'name',
            'model' => 'App\Models\WorldCity', // foreign key model
           // 'data_source'  => url('admin/searchcity'), // url to controller search
            'data_source'  => url('admin/searchcity/data8'),
            'placeholder' => '', // placeholder for the select
     //       'dependencies'  => ['data10','data8'], //this select2 is reset to null
       //     'dependencies'  => ['contact_addresses[0][data8]'],
            'minimum_input_length' => 0, // minimum before querying results
            'default' => Config::get('settings.contact_city'),
            ],

/*                [   'name' => 'data8',
                    'label' => trans('contact.address.region'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                ],                
                [   'name' => 'data7',
                    'label' => trans('contact.address.city'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                ],
*/

                [   'name' => 'data9',
                    'label' => trans('contact.address.postcode'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'addresses',
                ],                
                [   'name' => 'data6',
                    'label' => trans('contact.address.neigh'),
                    'type' => 'text',
                    'entity' => 'addresses',

                ],                



            ],
        ], 'both');

    //PHOTO
        $this->crud->addField([
            'name' => 'data14',
            'label' => trans('contact.photo.profile_image'),
            'type' => 'image',
            'tab'   => trans('contact.photos'),
            'entity' => 'names', 
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
    // 'disk' => 's3_bucket', // in case you need to show images from a different disk
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
                $this->crud->addClause('whereHas', 'events', function ($query) use ($value) {
                $query->whereNull('data4')->where(\DB::raw("substr(data1, 6, 2)"),$value)
                    ->orWhere(\DB::raw("substr(data1, 6,5)"),$value)->whereNull('data4');
                });
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
                $today = Carbon::today();
                if ($range->from) {
                    $datefrom = $today->subYears($range->from)->format('Y-m-d');
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($datefrom) {
                        $query->whereNotNull('data1')->whereNull('data4')
                            ->where('data1', '<=', $datefrom);
                    });
                } 

                if ($range->to) {
                    $dateto = $today->subYears($range->to)->format('Y-m-d');
                    $this->crud->addClause('whereHas', 'events', function ($query) use ($dateto) {
                        $query->whereNotNull('data1')->whereNull('data4')
                            ->where('data1', '>=', $dateto);
                    });
                }
            });

        // status filter
        $this->crud->addFilter([
            'name' => 'status',
            'label' => trans('contact.status'),
            'type' => 'dropdown',     
            ], 
            ContentType::getTypeStatus(),
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'status', $value);
            });
/*
        // select2_multiple filter
        $this->crud->addFilter([
            'name' => 'status',
            'label' => trans('contact.status'),
            'type' => 'select2_multiple',      
            ], 
            function() {return ContentType::getTypeStatus(); },
            function($values) { // if the filter is active
                foreach (json_decode($values) as $key => $value) {
                    $this->crud->addClause('orwhere', 'status', $value);
                }
            });
*/
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
        $response = $this->traitStore();
        // do something after save Parent, then save children
        $this->updateRelationFields();  
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

        $response = $this->traitUpdate();
        // do something after save
      //  dd($this->crud->entry); 
        $this->updateRelationFields(); 
     //   $this->updateDataFields(); 
      //   dd($response);
      //  dd($this->crud->entry); 

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
 /*
    public function getTypeSexes()
    {   
        $types = ContentType::all();
        $typeSexes = $types->where('mimetype', 'Sex')->sortBy('order')->pluck('label','type');
        return $typeSexes->toArray();
    }

    public function getTypePhones()
    {   
        $types = ContentType::all();
        $typePhones = $types->where('mimetype', 'Phone')->sortBy('order')->pluck('label','type');
        return $typePhones->toArray();
    }

    public function getTypeEmails()
    {   
        $types = ContentType::all();
        $typePhones = $types->where('mimetype', 'Email')->sortBy('order')->pluck('label','type');
        return $typePhones->toArray();
    }

    public function getTypeAddresses()
    {   
        $types = ContentType::all();
        $typePhones = $types->where('mimetype', 'Address')->sortBy('order')->pluck('label','type');
        return $typePhones->toArray();
    }
*/
    public function getNations()
    {   
    //    $options = WorldCountry::all();
    //    $options = $options->sortBy('name')->pluck('name','code_alpha3');
        $options = WorldCountry::orderBy('name')->pluck('name','code_alpha3');    
        return $options->toArray();
    }

    public function getCountries()
    {   
        $options = WorldCountry::all();
        $options = $options->sortBy('name')->pluck('name','id');
        return $options->toArray();
    }

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
        $tomorrow  = Carbon::tomorrow()->format('m-d');
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
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Deciembre',
        ];
        return $months;
    }
}

/*
 
//            'key'   => 'names.mimetype',
//            'attributes' => ['id' => 'namesmimetype'],
  //          'fake'  => true, // show the field, but don’t store 
   //         'store_in' => 'mimetype', // [optional] 
 //           'model' => 'App\Models\ContactName',   

                [
                'label'=>'Contacts Business', 'name'=>'contacts', 'attribute'=>'name','type'=>'select_multiple_callback','entity'=>'contactsbusiness', 'type_contact_id' => '1', 'model' => "App\Models\Contact", 'pivot' => true,
                
            
            ],
            [
                'label'=>'Contacts IS+T', 'name'=>'contacts2', 'attribute'=>'name','type'=>'select_multiple_callback','entity'=>'contactsist', 'type_contact_id' => '2', 'model' => "App\Models\Contact", 'pivot' => true,
                
            
            ],

            public function contactsbusiness() { return $this->belongsToMany('App\Models\Contact','applications_contacts') ->withPivot('application_id','contact_id') ->where('type_contact_id', 1) ->using(ContactPivot::class); } 
            public function contactsist() { return $this->belongsToMany('App\Models\Contact','applications_contacts') ->withPivot('application_id','contact_id') ->where('type_contact_id', 2) ->using(ContactPivot::class); }


// $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
            */