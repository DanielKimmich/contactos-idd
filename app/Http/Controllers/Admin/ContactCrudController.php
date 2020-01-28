<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Config;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Contact');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contact');
        $this->crud->setEntityNameStrings('contact', 'contacts');


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
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Text
            'name'  => 'display_name',
            'label' =>  trans('contact.full_name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
/*        $this->crud->addColumn([
            'name'  => 'sexo',
            'label' => trans('contact.sexo'),
            'type'  => 'text',
            'priority' => 2,
            ]); */
        $this->crud->addColumn([
            'name'  => 'sexo',
            'label' => trans('contact.sexo'),
            'type'  => 'select',
            'entity' => 'sex', 
            'attribute' => 'label',
            'priority' => 2,
            ]);
        $this->crud->addColumn([
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select',
            'entity' => 'nationality', 
            'attribute' => 'name',
            'priority' => 4,
            ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'text',
            'priority' => 2,
            ]);
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('contact.updated_at'),
            'type'  => 'text',
            'priority' => 3,
            ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContactRequest::class);
        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
// ------ CRUD FIELDS
        $this->crud->addField([ // Text
            'name'  => 'display_name',
            'label' => trans('contact.full_name'),
            'type'  => 'text',
           // 'prefix'   => "<i class='fa fa-home'></i>",
            'attributes' => ['readonly' => 'readonly'],
            ]);  
        $this->crud->addField([
            'name'  => 'update_fields',
            'type'  => 'update_contact_fields',
            ]);
    //NAME
        $this->crud->addField([ 
            'name'  => 'mimetype',
            'type'  => 'hidden',
            'value' => 'Name',
            'tab'   => 'Name',
            'attributes' => [ 'id' => 'namemimetype'],
            'entity' => 'name',             
            ], 'create');       
        $this->crud->addField([
            'name'  => 'data1',
            'type'  => 'hidden',
            'tab'   => 'Name',
            'attributes' => [ 'id' => 'namedata1'],
            'entity' => 'name', 
            ]);
        $this->crud->addField([
            'name'  => 'data2',
            'label' => trans('contact.name.name'),
            'type'  => 'text',
            'tab'   => 'Name',
            'attributes' => [ 'id' => 'namedata2'],
            'entity' => 'name', 
            ]);
        $this->crud->addField([
            'name'  => 'data5',
            'label' => trans('contact.name.middle'),
            'type'  => 'text',
            'tab'   => 'Name',
            'attributes' => [ 'id' => 'namedata5'],
            'entity' => 'name', 
            ]);
        $this->crud->addField([
            'name'  => 'data3',
            'label' => trans('contact.name.family'),
            'type'  => 'text',
            'tab'   => 'Name',
            'attributes' => [ 'id' => 'namedata3'],
            'entity' => 'name', 
            ]);

    //PHONE
        $this->crud->addField([ 
            'name'  => 'mimetype',
            'type'  => 'hidden',
            'value' => 'Phone',
            'tab'   => 'Phone',
            'attributes' => [ 'id' => 'phonemimetype'],
            'entity' => 'phone',             
            ], 'create');       
        $this->crud->addField([
            'name'  => 'data1',
            'label' => trans('contact.phone.number'),
            'type'  => 'text',
            'tab'   => 'Phone',
            'attributes' => [ 'id' => 'phonedata1'],
            'entity' => 'phone', 
            ]);
        $this->crud->addField([
            'name'  => 'data2',
            'label' => trans('contact.phone.Tipo'),
            'type'  => 'text',
            'tab'   => 'Phone',
            'attributes' => [ 'id' => 'phonedata2'],
            'entity' => 'phone', 
            ]);
        $this->crud->addField([
            'name'  => 'data3',
            'label' => trans('contact.phone.label'),
            'type'  => 'text',
            'tab'   => 'Phone',
            'attributes' => [ 'id' => 'phonedata3'],
            'entity' => 'phone', 
            ]);


    //DATA
       $this->crud->addField([ // Select
            'name'  => 'sexo',
            'label' => trans('contact.sexo'),
            'type'  => 'select2',
            'tab'   => 'Data',            
            'entity' => 'sex', 
            'attribute' => 'label',
//            'attributes' => [ 'id' => 'tipo', ],
            'options' => (function ($query) { 
                return $query->orderBy('order', 'ASC')->where('mimetype', 'Sexo')->get(); }) 
            ]);
/*
       $this->crud->addField([ // Text
            'name'  => 'sexo',
            'label' => trans('contact.sexo'),
            'type'  => 'radio',
            'tab'   => 'Data',
            'options'     => [ // the key will be stored in the db, the value will be shown as label; 
                'F' => "Femenino",
                'M' => "Masculino",
               // 'X' => "No Definido"
            ],
            'inline'      => true,
           ]);
*/

       $this->crud->addField([ // Select
            'name'  => 'nationality_id',
            'label' => trans('contact.nationality'),
            'type'  => 'select2',
            'tab'   => 'Data',            
            'entity' => 'nationality', 
            'attribute' => 'name',
            'default' => Config::get('settings.world_country'), // set default value
            'options' => (function ($query) { 
                return $query->orderBy('name', 'ASC')->get(); }) 
            ]);
        $this->crud->addField([ // Text
            'name'  => 'status',
            'label' => trans('contact.status'),
            'type'  => 'text',
            'tab'   => 'Data',
            ]);
        if ( $this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['readonly'  => 'readonly'],
            ]); //->beforeField('display_name'); 
         $this->crud->addField([ // Text
            'name'  => 'updated_at',
            'label' => trans('world.updated_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled']
            ]);     
         $this->crud->addField([ // Text
            'name'  => 'created_at',
            'label' => trans('world.created_at'),
            'type'  => 'text',
            'tab'   => 'Info',
            'attributes' => ['disabled'  => 'disabled']
            ]);   
        }
/*
    $this->crud->addField([ // Text
        'name'  => 'children_1',
        'label' => 'Items',
        'type'  => 'textarea',
        'tab'   => 'Rows',
        ]);
 
    $this->crud->addField([ // Table
            'name' => 'children',
            'label' => 'Options',
            'type' => 'table',
            'tab'   => 'Rows',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'id' => 'Id',
                'row_contact_id' => 'Contact_id',
                'mimetype' => 'Type',
                'data1' => 'Data',
                'data2' => 'Data',
                'data3' => 'Data',
              //  'data4' => 'Data',
              //  'data5' => 'Data',
              //  'data6' => 'Data',
              //  'data7' => 'Data',
              //  'data8' => 'Data',
              //  'data9' => 'Data',
               // 'data10' => 'Data',
              //  'data11' => 'Data',
             //   'data12' => 'Data',
              //  'data13' => 'Data',
              //  'data14' => 'Data',
              //  'data15' => 'Data',
              //  'created_at' => 'Creado', 
              //  'updated_at' => 'Actualizado',
            ],
           // 'fake' => true,
            'max' => 5, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
    ]);    


    $this->crud->addField([
        'name' => 'children_2',
        'label' => 'Line Items',
        'type' => 'line_items',
        'tab'   => 'Rows',
     //   'function' => function($entry) {
      //      return $entry->children->pluck('id');
       // }
    ]);
*/
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
