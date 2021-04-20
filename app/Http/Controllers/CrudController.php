<?php
/*
 * I've added updateRelationFields() to the crudcontroller, and for now I just call this on store/update in the crud controllers that use this field type.
 */

//namespace NineDotMedia\BackpackBase\Http\Controllers;
namespace App\Http\Controllers;
use Backpack\CRUD\app\Http\Controllers\CrudController as CrudControllerBackpack;
use Illuminate\Http\Request;
use Log;

//use NineDotMedia\BulkNotifications\Models\BulkNotification;

abstract class CrudController extends CrudControllerBackpack
{

    protected function setupLogOperation($action)
    {   
        switch ($action) {
            case 'index':
                Log::info('| route:' .$this->crud->getRoute() 
                        .' | user:' .auth()->user()->email);
                break;
            case 'store':
            case 'update':
            case 'destroy':                        
                Log::info('| route:' .$this->crud->getRoute() 
                        .' | user:' .auth()->user()->email
                        .' | operation:' .$action
                        .' | id:' .$this->crud->getCurrentEntryId());
                break;
            case 'default':
                Log::info('| route:' .$this->crud->getRoute() 
                        .' | user:' .auth()->user()->email
                        .' | operation:' .$action);
                break;
        }       
    }

    protected function setAccessOperation($ruta)
    {   //$ruta = 'worldcity';
    // ------ CRUD ACCESS
        if (auth()->user()->can($ruta.'.list' ) ) {
            $this->crud->allowAccess('list');
            $this->crud->enableExportButtons(); // ------ DATATABLE EXPORT BUTTONS
//            $this->crud->modifyButton('exportButtons', ['stack' => 'top']);
        } else {
            $this->crud->denyAccess('list');
        }
        if (auth()->user()->can($ruta.'.create' ) ) {
            $this->crud->allowAccess('create');
            $this->crud->allowAccess('clone');
            $this->crud->allowAccess('bulkClone');
        } else {
            $this->crud->denyAccess('create');
            $this->crud->denyAccess('clone');
            $this->crud->denyAccess('bulkClone');
        }
        if (auth()->user()->can($ruta.'.update') ) {
            $this->crud->allowAccess('update');
        } else {
            $this->crud->denyAccess('update');
        } 
        if (auth()->user()->can($ruta.'.show') ) {
            $this->crud->allowAccess('show');
        } else {
            $this->crud->denyAccess('show');
        }
        if (auth()->user()->can($ruta.'.delete') ) {
            $this->crud->allowAccess('delete');
            $this->crud->allowAccess('bulkDelete');
        } else {
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('bulkDelete');
        }
        // ------ CRUD BUTTONS
        if (auth()->user()->hasAnyPermission([$ruta.'.delete', $ruta.'create']))  { 
         //   $this->crud->enableBulkActions();
        }  


    }

    protected function getInfoColumns()
    {
        $this->crud->addColumn([
            'name' => 'updated_at_by_user',
            'label' => trans('common.updated_at'),
            'type' => 'closure',
            'function' => function($entry) {
                if (empty($entry->updated_by_user_name))
                    return $entry->updated_at;
                else
                    return $entry->updated_at.' ('.$entry->updated_by_user_name.')';
                }
            ]);
        $this->crud->addColumn([
            'name' => 'created_at_by_user',
            'label' => trans('common.created_at'),
            'type' => 'closure',
            'function' => function($entry) {
                if (empty($entry->created_by_user_name))
                    return $entry->created_at;
                else
                    return $entry->created_at.' ('.$entry->created_by_user_name.')';
                }
            ]); 
    }
    
    protected function getInfoFields()
    { 
        if ( $this->crud->actionIs('edit')) {
        $this->crud->addField([ // Text
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'attributes' => ['readonly'  => 'readonly'],
            'prefix'   => "<i class='la la-key'></i>", 
            ]); 
/*         $this->crud->addField([ // Text
            'name'  => 'blanco',
            'label' => '',
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'fake' => true,
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'attributes' => ['disabled'  => 'disabled'], 
            ]);     */
         $this->crud->addField([ // Text
            'name'  => 'updated_at',
            'label' => trans('common.updated_at'),
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='la la-calendar-check-o'></i>", 
            ]);     
         $this->crud->addField([ // Text
            'name'  => 'updated_by_user_name',
            'label' => trans('common.updated_by'),
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='la la-user-circle-o'></i>", 
            ]);     
         $this->crud->addField([ // Text
            'name'  => 'created_at',
            'label' => trans('common.created_at'),
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='la la-calendar-plus-o'></i>",
            ]);   
         $this->crud->addField([ // Text
            'name'  => 'created_by_user_name',
            'label' => trans('common.created_by'),
            'type'  => 'text',
            'tab'   => trans('common.info'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='la la-user-plus'></i>",
            ]);   
        }
    }

    protected function setFilterDateUpdate()
    {   // daterange filter
        $this->crud->addFilter([
            'name'  => 'updated_from_to',
            'label' => trans('common.updated_range'),
            'type'  => 'date_range',
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'updated_at', '>=', $dates->from);
                $this->crud->addClause('where', 'updated_at', '<=', $dates->to);
                //$this->crud->addClause('where', 'updated_at', '<=', $dates->to . ' 23:59:59');
            });
    }

    protected function updateRelationFields()
    {
        $fields = $this->crud->getCurrentFields();
        foreach($fields as $field){
            if($field['type'] === 'relationFields'){
                foreach($this->crud->getRequest()->{$field['name']} ?? [] as $relationFieldData){
                    if(!empty($relationFieldData['id'])){
                        if(!empty($relationFieldData[$field['foreignKey']])){
                        //update existing                          
                            $field['crud']->update($relationFieldData['id'], $relationFieldData);
                        } else {
                        //delete existing
                            $field['crud']->delete($relationFieldData['id']);
                        }
                    } else {
                        if(!empty($relationFieldData[$field['foreignKey']])){
                        //create existing
                            $field['crud']->create($relationFieldData); 
                        } else {  
                        //create new primary key from the nested crudpanel
                            $relationFieldData[$field['foreignKey']] = $this->data['entry']->id;
                            //$this->crud->entry->getKey();
                            //$this->crud->getCurrentEntryId();
                            $field['crud']->create($relationFieldData); 
                        }
                    }
                }
            }
        }
    }

    
}