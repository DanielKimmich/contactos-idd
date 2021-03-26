<?php

//namespace Backpack\Settings\app\Http\Controllers;
namespace App\Http\Controllers\Admin;

//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController as OriginalRoleCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SettingCrudController extends OriginalRoleCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    public function setup()
    {
        CRUD::setModel("Backpack\Settings\app\Models\Setting");
        CRUD::setEntityNameStrings(trans('backpack::settings.setting_singular'), trans('backpack::settings.setting_plural'));
        CRUD::setRoute(backpack_url('setting'));
    }

    public function setupListOperation()
    {
        // only show settings which are marked as active
      //  CRUD::addClause('where', 'active', 1);
   //     $this->setupAvancedOperation();
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
         $this->crud->addColumn([
            'name'  => 'active',
            'label' => trans('backpack::settings.active'),
            'type'  => 'check',
            'priority' => 1,
            ]);
         $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('backpack::settings.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
         $this->crud->addColumn([
            'name'  => 'key',
            'label' => trans('backpack::settings.key'),
            'type'  => 'text',
            'priority' => 2,
            ]);
         $this->crud->addColumn([
            'name'  => 'value',
            'label' => trans('backpack::settings.value'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('backpack::settings.description'),
            'type'  => 'text',
            'priority' => 3,
            'limit' => 100,
            ]);
        // columns to show in the table view
 /*       CRUD::setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::settings.name'),
            ],
            [
                'name'  => 'value',
                'label' => trans('backpack::settings.value'),
            ],
            [
                'name'  => 'description',
                'label' => trans('backpack::settings.description'),
            ],
        ]); */
    }

    public function setupUpdateOperation()
    {
        CRUD::addField([
            'name'       => 'name',
            'label'      => trans('backpack::settings.name'),
            'type'       => 'text',
            'attributes' => ['disabled' => 'disabled', ],
        ]);

        CRUD::addField([
            'name'       => 'key',
            'label'      => trans('backpack::settings.key'),
            'type'       => 'text',
            'attributes' => ['disabled' => 'disabled', ],
        ]);

        CRUD::addField(json_decode(CRUD::getCurrentEntry()->field, true));

        CRUD::addField([
            'name'       => 'description',
            'label'      => trans('backpack::settings.description'),
            'type'       => 'text',
        ]);

        CRUD::addField([
            'name'  => 'active',
            'label' => trans('backpack::settings.active'),
            'type'  => 'checkbox',
        ]);

    //INFO
        $this->getInfoFields();

    }
}
