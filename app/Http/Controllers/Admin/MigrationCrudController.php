<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MigrationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MigrationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class MigrationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Migration');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/migration');
        $this->crud->setEntityNameStrings('migration', 'migrations');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        // remove a column from the stack
        $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');
        // $this->crud->removeColumn('column_name');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(MigrationRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
