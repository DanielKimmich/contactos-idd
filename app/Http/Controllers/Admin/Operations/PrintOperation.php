<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait PrintOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupPrintRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/print', [
            'as'        => $routeName.'.print',
            'uses'      => $controller.'@print',
            'operation' => 'print',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupPrintDefaults()
    {
        $this->crud->allowAccess('print');

        $this->crud->operation('print', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation(['list', 'show'], function () {
            // $this->crud->addButton('top', 'print', 'view', 'crud::buttons.print');
            $this->crud->addButton('line', 'print', 'view', 'crud::buttons.print');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function print($id)
    {
        $this->crud->hasAccessOrFail('print');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'print '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.print", $this->data);
    }
}
