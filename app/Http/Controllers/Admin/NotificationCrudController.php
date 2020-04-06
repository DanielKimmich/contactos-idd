<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NotificationRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Notification;

/**
 * Class NotificationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NotificationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Notification');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/notification');
        $this->crud->setEntityNameStrings(trans('blog.notification.entity_name'), trans('blog.notification.entity_names'));
        $this->setupAvancedOperation();
//        $this->setAccessOperation('notification');

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
            'name'  => 'title',
            'label' =>  trans('blog.notification.title'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'color',
            'label' => trans('blog.notification.color'),
            'type'  => 'select_from_array',
            'priority'  => 2,
            'options'   => Notification::getTypeColor(),
            ]); 
        $this->crud->addColumn([
            'name'  => 'priority',
            'label' => trans('blog.notification.priority'),
            'type'  => 'select_from_array',
            'priority'  => 2,
            'options'   => Notification::getTypePriority(),
            ]); 
        $this->crud->addColumn([ // Text
            'name'  => 'expires_at',
            'label' =>  trans('blog.notification.expires_at'),
            'type'  => 'date',
            'priority' => 3,
            'format' => 'YYYY-MM-DD', //default base.default_date_format config value
            ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NotificationRequest::class);

// ------ CRUD FIELDS
    //DATA
        $this->crud->addField([
            'name'  => 'title',
            'label' => trans('blog.notification.title'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            ]);        
        $this->crud->addField([
            'name'  => 'body',
            'label' => trans('blog.notification.body'),
            'type'  => 'textarea',
            'tab'   => trans('blog.data'),
            ]);
        $this->crud->addField([
            'name'  => 'color',
            'label' => trans('blog.notification.color'),
            'type'  => 'select_from_array',
            'tab'   => trans('blog.data'),
            'wrapper' => ['class' => 'form-group col-md-6'],
            'options'    => Notification::getTypeColor(),
            'default'    => 'GREEN',
            ]);
        $this->crud->addField([ // Text
            'name'  => 'priority',
            'label' => trans('blog.notification.priority'),
            'type'  => 'select_from_array',
            'tab'   => trans('blog.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            'options'    => Notification::getTypePriority(),
            'default'    => 'DEFAULT',
            ]);
        $this->crud->addField([
            'name'  => 'expires_at',
            'label' => trans('blog.notification.expires_at'),            
            'type'  => 'date',
            'tab'   => trans('contact.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing
            ]);
    //INFO
        $this->getInfoFields(); 

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('expires_at', 'desc');

    // ------ CRUD FILTERS
        // daterange filter
        $this->setFilterDateUpdate();
    }

}
