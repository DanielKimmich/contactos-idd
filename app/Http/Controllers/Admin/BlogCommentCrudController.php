<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogCommentRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\BlogComment;

/**
 * Class BlogCommentsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogCommentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\BlogComment');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blogcomment');
        $this->crud->setEntityNameStrings(trans('blog.comment.entity_name'), trans('blog.comment.entity_names'));
        $this->setAccessOperation('blogcomment');
    }

    protected function setupListOperation()
    {
        $this->setupAvancedOperation();
// ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'Id',
            'type'  => 'number',
            'priority'  => 2,
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Select
            'name'  => 'post_id',
            'label' => trans('blog.comment.title'),
            'type'  => 'select',
            'priority'  => 1,
            'entity'    => 'posts', 
            'attribute' => 'title',
            ]);     
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('blog.comment.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => BlogComment::getTypeStatus(),
            ]);
        $this->crud->addColumn([
            'name'  => 'created_by_user',
            'label' => trans('blog.created_by'),
            'type'  => 'text',
            'priority'  => 3,
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
            ]) -> makeFirstColumn() ;
        $this->crud->addColumn([ // Select
            'name'  => 'post_id',
            'label' => trans('blog.comment.title'),
            'type'  => 'select',
            'entity'    => 'posts', 
            'attribute' => 'title',
            ]);     
        $this->crud->addColumn([    // EDITOR
            'name'  => 'body',
            'label' => trans('blog.comment.body'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('blog.comment.status'),
            'type'  => 'select_from_array',
            'options'   => BlogComment::getTypeStatus(),
            ]);
    //INFO
        $this->getInfoColumns();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BlogCommentRequest::class);
    //DATA
        $this->crud->addField([    // SELECT
            'name'  => 'post_id',
            'label' => trans('blog.comment.title'),
            'type'  => 'select2',
            'tab'   => trans('blog.data'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields 
            'entity'    => 'posts',
            'attribute' => 'title',
            'model'     => 'App\Models\BlogPost',
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get(); }), 
            ]);
        $this->crud->addField([    // EDITOR
            'name'  => 'body',
            'label' => trans('blog.comment.body'),
            'type'  => 'ckeditor',
            'tab'   => trans('blog.data'),            
            'placeholder' => 'Your textarea text here',
            ]);
        $this->crud->addField([    // SELECT
            'name'  => 'status',
            'label' => trans('blog.comment.status'),
            'type'  => 'select_from_array',
            'tab'   => trans('blog.data'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'], //resizing fields
            'options'   => BlogComment::getTypeStatus(),            
        ]);
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->addField([    // TEXT
            'name'  => 'slug',
            'label' => trans('blog.comment.slug'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            'hint'  => trans('blog.comment.slug_hint'),
            'prefix'    => "<i class='fa fa-link'></i>",
            ]);
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('updated_at', 'desc');

    // ------ CRUD FILTERS
        // daterange filter
        $this->setFilterDateUpdate();
    }
    
}
