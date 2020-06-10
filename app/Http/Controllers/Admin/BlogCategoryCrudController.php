<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogCategoryRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogCategoriesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; } 
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\BlogCategory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blogcategory');
        $this->crud->setEntityNameStrings(trans('blog.category.entity_name'), trans('blog.category.entity_names'));
        $this->setAccessOperation('blogcategory');
    }

    protected function setupListOperation()
    {
        $this->setupAvancedOperation();
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority' => 2,
            ]) -> makeFirstColumn() ;
         $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('blog.category.name'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('blog.category.description'),
            'type'  => 'text',
            'priority' => 3,
            'limit' => 100,
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
            'searchLogic' => false,
            ]); 

    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            ]);
         $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('blog.category.name'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('blog.category.description'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'label' => trans('blog.category.slug'),
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
    }
    
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BlogCategoryRequest::class);
    //DATA
        $this->crud->addField([ // TYPE
            'name'  => 'name',
            'label' => trans('blog.category.name'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            ]);
        $this->crud->addField([ // LABEL
            'name'  => 'description',
            'label' => trans('blog.category.description'),
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
            'label' => trans('blog.category.slug'),
            'type' => 'text',
            'tab'   => trans('blog.data'),
            'hint' => trans('blog.category.slug_hint'),
            // 'attributes' => ['disabled'  => 'disabled'],
            'prefix'   => "<i class='la la-link'></i>",
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

    // OPTIONAL
    // only if you want to make the InlineCreateOperation behave differently 
    // from the CreateOperation, otherwise you can just skip the setup method entirely
    // 
/*
    protected function setupInlineCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        $this->crud->addField($field_definition_array);
    }
*/
}
