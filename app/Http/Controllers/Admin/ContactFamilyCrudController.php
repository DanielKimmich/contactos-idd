<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FamilyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ContentType;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ContactFamily');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contactfamily');
        $this->crud->setEntityNameStrings(trans('contact.family.entity_name'), trans('contact.family.entity_names'));
    }

    protected function setupListOperation()
    {
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
            'name'  => 'sex_id',
            'label' => trans('contact.family.sex'),
            'type'  => 'select_from_array',
            'priority'  => 4,
            'options'   => ContentType::getTypeSexes(),
            ]); 
        $this->crud->addColumn([
            'name'  => 'civil_status',
            'label' => trans('contact.family.civil_status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeCivilStatus(),
            ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('contact.family.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => ContentType::getTypeStatus(),
            ]);
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
            'wrapper' => ['class' => 'form-group col-md-8'],
            'prefix'     => '<i class="la la-id-card-o"></i>',
            'attributes' => ['id' => 'display_name', 'readonly' => 'readonly'],
            ]);  
        $this->crud->addField([ // Text
            'name'  => 'civil_status',
            'label' => trans('contact.family.civil_status'),
            'type'  => 'select_from_array',
            'wrapper' => ['class' => 'form-group col-md-4'],
            'options'    => ContentType::getTypeCivilStatus(),
            'allows_null' => true,
            ]);        

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
                [   'name'  => 'data1',
                    'label' => trans('contact.parent.name'),
                    'type'  => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.parent.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationParents(),
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
                [   'name'  => 'data1',
                    'label' => trans('contact.spouse.name'),
                    'type'  => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.spouse.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationSpouses(),
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
                [   'name'  => 'data1',
                    'label' => trans('contact.children.name'),
                    'type'  => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.children.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationChildren(),
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
                [   'name'  => 'data1',
                    'label' => trans('contact.relative.name'),
                    'type'  => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.relative.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationRelatives(),
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
                [   'name'  => 'data1',
                    'label' => trans('contact.other.name'),
                    'type'  => 'text',
                    'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                ],
                [   'name'  => 'data2',
                    'label' => trans('contact.other.type'),
                    'type'  => 'select_from_array',
                    'wrapper' => ['class' => 'form-group col-md-4'], 
                    'options' => ContentType::getTypeRelationOthers(),
                ],  
                [   'name'  => 'data3',
                    'label' => trans('contact.other.label'),
                    'type'  => 'text',
                ],
            ],
        ]);

    }



}
