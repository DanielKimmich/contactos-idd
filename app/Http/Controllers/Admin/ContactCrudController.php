<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ContactRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Illuminate\Support\Facades\Config;
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
 /*       [
        'label' => 'App',
        'name' => 'app.name', // relation.column_name
    ],   
    Also add a $this->crud->with(['app', 'user'])  */

        $this->crud->addColumn([
            'name'  => 'events.data7',
            'label' =>  trans('contact.event.birthday'),
            'type'  => 'text',
            'priority' => 2,
            ]);    
        $this->crud->addColumn([
            'name'  => 'sexo',
            'label' => trans('contact.sex'),
            'type'  => 'select',
            'priority' => 4,
            'entity' => 'sex', 
            'attribute' => 'label',
            ]);
/*         $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select',
            'priority' => 2,
            'entity' => 'nationality', 
            'attribute' => 'name',
            ]);  
       $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select_from_array',
            'priority' => 2,
            'options'   => $this->getCountries(),
            ]);     */
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            'priority' => 3,
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
            'name'  => 'sexo',
            'label' => trans('contact.sex'),
            'type'  => 'select',
            'entity' => 'sex', 
            'attribute' => 'label',
            ]);
        $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select',
            'entity' => 'nationality', 
            'attribute' => 'name',
            ]);  
        $this->crud->addColumn([
            'name'  => 'events.data7',
            'label' =>  trans('contact.event.birthday'),
            'type'  => 'text',
            ]);  
        $this->crud->addColumn([
            'name'  => 'documents.data9',
            'label' =>  trans('contact.document.number'),
            'type'  => 'text',
            ]);  
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
            'type'  => 'text',
            ]);
        $this->crud->addColumn([    
            'name'  => 'created_at',
            'label' => trans('common.created_at'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            ]);       
    }      


    protected function setupCreateOperation()
    {   //$this->crud->setCreateContentClass('col-md-8 col-md-offset-2');
        $this->crud->setValidation(ContactRequest::class);
// ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.display_name'),
            'type'  => 'text',
            'prefix'   => '<i class="fa fa-id-card-o"></i>',
            'attributes' => ['id' => 'display_name', 'readonly' => 'readonly'],
            ]);  
        $this->crud->addField([ // Text
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'hidden',
            'value' => 'Active',
        //    'fake'  => true,
        //    'store_in' => 'status',
            ]);

        $this->crud->addField([
            'name'  => 'update_fields',
            'type'  => 'update_fields_contact',
            ]);

    //NAME
        $this->crud->addField([
            'name'  => 'data1',
            'type'  => 'hidden',
            'tab'   => 'Name', 
            'attributes' => ['id' => 'full_name'],
            'entity' => 'names', 
        //    'model' => 'App\Models\ContactName',
        //    'fake'  => true,
        //    'store_in' => 'data1',
            ]);

        $this->crud->addField([
            'name'  => 'data2',
            'label' => trans('contact.name.first'),
            'type'  => 'text',
            'tab'   => 'Name',
            'attributes' => ['id' => 'first_name'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
            'entity' => 'names', 
         //   'model' => 'App\Models\ContactName',
        //    'fake'  => true,
        //    'store_in' => 'data2',
            ]);
        $this->crud->addField([
            'name'  => 'data5',
            'label' => trans('contact.name.middle'),
            'type'  => 'text',
            'tab'   => 'Name',
            'attributes' => ['id' => 'middle_name'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
            'entity' => 'names', 
         //   'model' => 'App\Models\ContactName',
        //    'fake'  => true,
        //    'store_in' => 'data5',
            ]);

        $this->crud->addField([
            'name'  => 'data3',
            'label' => trans('contact.name.family'),
            'type'  => 'text',
            'attributes' => ['id' => 'family_name'],
            'tab'   => 'Name',
            'entity' => 'names', 
        //    'model' => 'App\Models\ContactName',
        //    'fake'  => true,
        //    'store_in' => 'data3',
            ]);

    //DATA
        $this->crud->addField([ // Text
            'name'  => 'sexo',
            'label' => trans('contact.sex'),
            'type'  => 'radio',
            'tab'   => 'Data',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
            'inline'      => true,      
            'options'     => $this->getTypeSexes(),
            //'options'     => [ 'F' => "Femenino", 'M' => "Masculino"],
           ]);
/*
        $this->crud->addField([ 
            'name'  => 'mimetype',
            'label' => 'mimetype',
            'type'  => 'hidden',
            'tab'   => 'Data',
            'key'   => 'events.mimetype',
            'value' => 'Event',
            'entity' => 'events', 
       //     'pivot' => true,  
        //    'morph' => true,
         //        'model' => 'App\Models\ContactEvent',       
            ]);       
 */
        $this->crud->addField([
            'name'  => 'data7',
            'label' => trans('contact.event.birthday'),            
            'type'  => 'date',
            'tab'   => 'Data',
            'attributes' => ['id' => 'event_date'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing
      //      'key'   => 'events.date',
            'entity' => 'events',
      //      'fake' => true, 
       //     'store_in' => 'data6', // [optional]
        //    'pivot' => true,
        //    'morph' => true,
       //     'model' => 'App\Models\ContactEvent',
            ]);

        $this->crud->addField([        
            'name'  => 'data8',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => 'Data',
            'attributes' => ['id' => 'event_type'],
         //   'key'   => 'events.type',
            'value' => 'TYPE_BIRTHDAY',
            'entity' => 'events', 
       //     'fake' => true,
      //      'store_in' => 'data4', // [optional]
        //    'pivot' => true,  
         //   'morph' => true, 
        //    'model' => 'App\Models\ContactEvent',         
            ]);       

        $this->crud->addField([
            'name'  => 'data9',
            'label' => trans('contact.document.number'),            
            'type'  => 'text',
            'tab'   => 'Data',
            'attributes' => ['id' => 'event_date'],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing    
      //      'key'   => 'events.date',
            'entity' => 'documents',
      //      'fake' => true, 
       //     'store_in' => 'data6', // [optional]
        //    'pivot' => true,
        //    'morph' => true,
       //     'model' => 'App\Models\ContactEvent',
            ]);

        $this->crud->addField([        
            'name'  => 'data10',
            'label' => 'data2',
            'type'  => 'hidden',
            'tab'   => 'Data',
            'attributes' => ['id' => 'event_type'],             
         //   'key'   => 'events.type',
            'value' => 'TYPE_DOC',
            'entity' => 'documents', 
       //     'fake' => true,
      //      'store_in' => 'data4', // [optional]
        //    'pivot' => true,  
         //   'morph' => true, 
        //    'model' => 'App\Models\ContactEvent',         
            ]); 
/*        $this->crud->addField([ // Select
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select2',
            'tab'   => 'Data', 
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing      
            'entity' => 'nationality', 
            'attribute' => 'name',
            'options' => (function ($query) { 
                return $query->orderBy('name', 'ASC')->get(); }), 
            'default' => Config::get('settings.world_country'), // set default value
            ]);   */

        $this->crud->addField([ // Select
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select2_from_array',
            'tab'   => 'Data', 
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing      
            'options'   => $this->getCountries(),
            // 'allows_null' => true,
            'default' => Config::get('settings.contact_country'),
            ]);

    //PHONE
        $this->crud->addField([
            'name' => 'contact_phones',
            'label' => trans('contact.phone.titles'),
            'type' => 'relationFields',
            'tab' => 'Phone',
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
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                    'entity' => 'phones',
                ],
                [   'name' => 'data2',
                    'label' => trans('contact.phone.type'),
                    'type' => 'select_from_array',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'phones',
                    'options'     => $this->getTypePhones(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.phone.label'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'phones',
                ],
            ],
        ], 'both');

    //EMAIL
        $this->crud->addField([
            'name' => 'contact_emails',
            'label' => trans('contact.email.titles'),
            'type' => 'relationFields',
            'tab' => 'Email',
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
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                    'entity' => 'emails',
                    'options'     => $this->getTypeEmails(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.email.label'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
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
            'tab' => 'Address',
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
                    'prefix'   => '<i class="fa fa-map-marker"></i>',
                    'attributes' => ['readonly' => 'readonly'],
                    'entity' => 'addresses',
                ],
                [   'name' => 'data2',
                    'label' => trans('contact.address.type'),
                    'type' => 'select_from_array',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'addresses',
                    'options'     => $this->getTypeAddresses(),
                    'allows_null' => true,
                ],
                [   'name' => 'data3',
                    'label' => trans('contact.address.label'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
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
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                    'options'   => $this->getCountries(),
                    'default' => Config::get('settings.contact_country'),
                ],
            [
            'name'  => 'data8',
            'label' => trans('contact.address.division'),
            'type'  => 'select2_from_ajax',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'entity' => 'addresses', 
            'attribute' => 'name',
            'model' => 'App\Models\WorldDivision', // foreign key model
            'data_source'  => url('admin/searchdivision/data10'), // url to controller search
            'placeholder' => '', // placeholder for the select
      //      'dependencies'  => ['data10'], //this select2 is reset to null
            'minimum_input_length' => 0, // minimum before querying results
            ],
            [
            'name'  => 'data7',
            'label' => trans('contact.address.city'),
            'type'  => 'select2_from_ajax',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'entity' => 'addresses', 
            'attribute' => 'name',
            'model' => 'App\Models\WorldCity', // foreign key model
           // 'data_source'  => url('admin/searchcity'), // url to controller search
            'data_source'  => url('admin/searchcity/data8'),
            'placeholder' => '', // placeholder for the select
     //       'dependencies'  => ['data10','data8'], //this select2 is reset to null
       //     'dependencies'  => ['contact_addresses[0][data8]'],
            'minimum_input_length' => 0, // minimum before querying results
            ],

/*                [   'name' => 'data8',
                    'label' => trans('contact.address.region'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                ],                
                [   'name' => 'data7',
                    'label' => trans('contact.address.city'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                    'entity' => 'addresses',
                ],
*/

                [   'name' => 'data9',
                    'label' => trans('contact.address.postcode'),
                    'type' => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-6'], 
                    'entity' => 'addresses',
                ],                
                [   'name' => 'data6',
                    'label' => trans('contact.address.neigh'),
                    'type' => 'text',
                    'entity' => 'addresses',

                ],                



            ],
        ], 'both');


    //INFO
        $this->getInfoFields();

//dump($this->crud);
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
       // $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        // Role Filter
/*
        $this->crud->addFilter([
            'name'  => 'role',
            'label' => trans('backpack::permissionmanager.role'),
            'type'  => 'dropdown',
            ],
            config('permission.models.role')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'roles', function ($query) use ($value) {
                    $query->where('role_id', '=', $value);
                });
            });
*/
        // daterange filter
        $this->setFilterDateUpdate();
    }


    protected function setupUpdateOperation()
    {
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
    public function deleteClientPhone(ContactRequest $request, ContactData $phone)
    {
        if ($id = $request->input('id')) {
            $phone->findOrFail($id)->delete();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'messages' => [trans('phone.phone_id_is_required')]]);
    }

    public function getTypeSexes()
    {   
        $types = ContentType::all();
        $typeSexes = $types->where('mimetype', 'Sexo')->sortBy('order')->pluck('label','id');
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



    function renameKey($oldkey, $newkey, $array) {
        $val = $array[$oldkey]; 
        $tmp_A = array_flip($array); 
        $tmp_A[$val] = $newkey; 
        return array_flip($tmp_A); 
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