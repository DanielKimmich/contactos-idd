<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogTagRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogTagsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogTagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; } 
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;


    public function setup()
    {
        $this->crud->setModel('App\Models\BlogTag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blogtag');
        $this->crud->setEntityNameStrings(trans('blog.tag.title'), trans('blog.tag.titles'));
        $this->setupAvancedOperation();
        $this->setAccessOperation('blogtag');
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
         $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('blog.tag.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('blog.tag.description'),
            'type'  => 'text',
            'priority' => 3,
            ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'label' => trans('blog.tag.slug'),
            'type' => 'text',
            'priority' => 4,
            'exportOnlyField' => true,  //forced to exportfield and hidden in table            
            ]);    
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('blog.updated_at'),
            'type'  => 'text',
            'priority' => 4,
            ]); 
//$this->crud->addButton('top', 'export_buttons', 'view', 'crud::inc.export_buttons', 'end');
//$this->crud->modifyButton('exportButtons', ['position' => 'end']);
//$this->crud->modifyButton('exportbuttons', ['stack' => 'top']);
$this->crud->orderButtons('line', ['show','update','delete']);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', true);
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            ]);
         $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('blog.tag.name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('blog.tag.description'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'label' => trans('blog.tag.slug'),
            'type' => 'text',
            ]);            
        $this->crud->addColumn([    
            'name'  => 'created_at',
            'label' => trans('blog.created_at'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_at',
            'label' => trans('blog.updated_at'),
            'type'  => 'text',
            ]); 
        $this->crud->addColumn([    
            'name'  => 'created_by_user',
            'label' => trans('blog.created_by'),
            'type'  => 'text',
            ]);       
        $this->crud->addColumn([    
            'name'  => 'updated_by_user',
            'label' => trans('blog.updated_by'),
            'type'  => 'text',
            ]); 
        $this->crud->addButton('line', 'clone', 'view', 'crud::buttons.clone', 'end');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BlogTagRequest::class);
    //DATA
        $this->crud->addField([ // TYPE
            'name'  => 'name',
            'label' => trans('blog.tag.name'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            ]);
        $this->crud->addField([ // LABEL
            'name'  => 'description',
            'label' => trans('blog.tag.description'),
            'type'  => 'textarea',
            'tab'   => trans('blog.data'),
            ]);

    //INFO
        $this->getInfoFields(); 
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->addField([
            'name' => 'slug',
            'label' => trans('blog.tag.slug'),
            'type' => 'text',
            'tab'   => trans('blog.data'),
            'hint' => trans('blog.tag.slug_hint'),
            // 'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='fa fa-link'></i>",
            ]);
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('name');

    // ------ CRUD FILTERS
        // daterange filter
        $this->setFilterDateUpdate();
    }
    
    public function clone($id)
    {
        $this->crud->hasAccessOrFail('clone');

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();
    // whatever you want
        $clonedEntry->name = $clonedEntry->name .' ' .'[clone]';

        return (string) $clonedEntry->push();
    }

}
