<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogPostRequest;
//use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\BlogPost;

/**
 * Class BlogPostsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogPostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation { clone as traitClone; } 
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;


    public function setup()
    {
        $this->crud->setModel('App\Models\BlogPost');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blogpost');
        $this->crud->setEntityNameStrings(trans('blog.post.entity_name'), trans('blog.post.entity_names'));
        $this->setAccessOperation('blogpost');
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
         $this->crud->addColumn([
            'name'  => 'title',
            'label' => trans('blog.post.title'),
            'type'  => 'text',
            'priority' => 1,
            ]);
        $this->crud->addColumn([ // Select
            'name'  => 'author_id',
            'label' => trans('blog.post.author'),
            'type'  => 'select',
            'priority'  => 2,
            'entity'    => 'contacts', 
            'attribute' => 'display_name',
            ]); 
         $this->crud->addColumn([
            'name'  => 'comments_count',
            'label' => trans('blog.post.comments'),
            'type'  => 'text',
            'priority' => 3,
            ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('blog.post.status'),
            'type'  => 'select_from_array',
            'priority'  => 3,
            'options'   => BlogPost::getTypeStatus(),
            ]);
        $this->crud->addColumn([    
            'name'  => 'posted_at',
            'label' => trans('blog.post.posted_at'),
            'type'  => 'text',
            'priority' => 4,
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
        $this->crud->addColumn([ // Select
            'name'  => 'author_id',
            'label' => trans('blog.post.author'),
            'type'  => 'select',
            'entity'    => 'contacts', 
            'attribute' => 'display_name',
            ]); 
        $this->crud->addColumn([ // Select
            'name'  => 'category_id',
            'label' => trans('blog.post.category'),
            'type'  => 'select',
            'entity'    => 'category', 
            'attribute' => 'name',
            ]); 
         $this->crud->addColumn([
            'name'  => 'title',
            'label' => trans('blog.post.title'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => trans('blog.post.description'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'  => 'body',
            'label' => trans('blog.post.body'),
            'type'  => 'text',
            ]);
        $this->crud->addColumn([
            'name'      => 'tags', // the method that defines the relationship in your Model
            'label'     => trans('blog.post.tags'),
            'type'      => 'select_multiple',
            'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            ]);
        $this->crud->addColumn([
            'name'  => 'posted_at',
            'label' => trans('blog.post.posted_at'),
            'type'  => 'text',
            ]); 
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => trans('blog.post.status'),
            'type'  => 'select_from_array',
            'options'   => BlogPost::getTypeStatus(),            
        ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'label' => trans('blog.post.slug'),
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
        $this->crud->setValidation(BlogPostRequest::class);
    //DATA
        $this->crud->addField([    // SELECT
            'name'  => 'author_id',
            'label' => trans('blog.post.author'),
            'type'  => 'select2',
            'tab'   => trans('blog.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing fields 
            'entity'    => 'contacts',
            'attribute' => 'display_name',
            'model'     => 'App\Models\ContactPerson',
            'options'   => (function ($query) {
                return $query->orderBy('display_name', 'ASC')->get(); }), 
            ]);
    if (auth()->user()->can('increate blogpost') ) {
        $this->crud->addField([    // Relationship
            'name'  => 'category_id',
            'label' => trans('blog.post.category'),
            'type'  => 'relationship',
            'tab'   => trans('blog.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'],           
          //  'entity'    => 'category',
            'attribute' => 'name',
            'model'     => 'App\Models\BlogCategory',
         //   'data_source' => url($this->crud->route.'/fetch/category'),
    //        'options'   => (function ($query) {
    //            return $query->orderBy('name', 'ASC')->get(); }),
          //  'ajax' => true,
         //   'minimum_input_length' => 0, //minimum characters before querying results
     //      'inline_create' => true, // TODO: make this work
            'inline_create' => ['entity' => 'blogcategory'],
            ]);
    } else {
        $this->crud->addField([    // SELECT
            'name'  => 'category_id',
            'label' => trans('blog.post.category'),         
            'type'  => 'select2',
            'tab'   => trans('blog.data'),
            'wrapper'   => ['class' => 'form-group col-md-6'], //resizing fields 
            'entity'    => 'category',
            'attribute' => 'name',
            'model'     => 'App\Models\BlogCategory',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get(); }), 
            ]); 
    }
        $this->crud->addField([    // TEXT 
            'name'  => 'title',
            'label' => trans('blog.post.title'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            ]);
        $this->crud->addField([    // TEXTAREA 
            'name'  => 'description',
            'label' => trans('blog.post.description'),
            'type'  => 'textarea',
            'tab'   => trans('blog.data'),
            ]);
        $this->crud->addField([    // EDITOR
            'name'  => 'body',
            'label' => trans('blog.post.body'),
            'type'  => 'ckeditor',
            'tab'   => trans('blog.data'),            
            'placeholder' => 'Your textarea text here',
            ]);
    if (auth()->user()->can('increate blogpost') ) {
        $this->crud->addField([    // Relationship
            'name'  => 'tags',
            'label' => trans('blog.post.tags'),
            'type'  => 'relationship',
            'tab'   => trans('blog.data'),
            'entity'    => 'tags',
            'attribute' => 'name',
            'model'     => 'App\Models\BlogTag',
            'ajax' => true,
            'minimum_input_length' => 0, //minimum characters before querying results
           'inline_create' => ['entity' => 'blogtag'], 
            ]);
    } else {
        $this->crud->addField([   // Select2Multiple 
            'name'  => 'tags', // the method relationship in your Model
            'label' => trans('blog.post.tags'),
            'type'  => 'select2_multiple',
            'tab'   => trans('blog.data'),
            'entity'    => 'tags', // the method relationship in your Model
            'attribute' => 'name', // foreign key attribute shown to user
            'model' => 'App\Models\BlogTag', // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot
            ]);
    }
        $this->crud->addField([    // DATE create 
            'name'  => 'posted_at',
            'label' => trans('blog.post.posted_at'),
            'type'  => 'date',
            'tab'   => trans('blog.data'),             
            'default' => date('Y-m-d'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing fields
            ]); 
        $this->crud->addField([    // SELECT
            'name'  => 'status',
            'label' => trans('blog.post.status'),
            'type'  => 'select_from_array',
            'tab'   => trans('blog.data'),
            'wrapper' => ['class' => 'form-group col-md-6'], //resizing fields
            'options' => BlogPost::getTypeStatus(),            
        ]);
        
    //INFO
        $this->getInfoFields(); 
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->addField([    // TEXT
            'name'  => 'slug',
            'label' => trans('blog.post.slug'),
            'type'  => 'text',
            'tab'   => trans('blog.data'),
            'hint'  => trans('blog.post.slug_hint'),
            'prefix'    => "<i class='la la-link'></i>",
            ]);
    }

    protected function setupAvancedOperation()
    {
    // ------ ADVANCED QUERIES  
        $this->crud->orderBy('updated_at', 'desc');

    // ------ CRUD FILTERS
        //Contact filter
        $this->crud->addFilter([
            'name'  => 'author_id',
            'label' => trans('blog.post.author'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\ContactPerson::all()->sortBy('display_name')->pluck('display_name', 'id')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'author_id', $value ); });

        //Category filter
        $this->crud->addFilter([
            'name'  => 'category_id',
            'label' => trans('blog.post.category'),
            'type'  => 'select2',
            ],
            function() {
                return \App\Models\BlogCategory::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
            function($value) {  
                $this->crud->addClause('where', 'category_id', $value ); });

        // Has Tags Filter
        $this->crud->addFilter([
            'name'  => 'tags',
            'label' => trans('blog.post.tags'),
            'type'  => 'dropdown',
            ],
        function() {
                return \App\Models\BlogTag::all()->sortBy('name')->pluck('name', 'id')->toArray(); },
        function ($value) { // if the filter is active
            $this->crud->addClause('whereHas', 'tags', function ($query) use ($value) {
                $query->where('tag_id', '=', $value);
            });
        });

        // posted_at filter
        $this->crud->addFilter([
            'name'  => 'posted_from_to',
            'label' => trans('blog.post.posted_at'),
            'type'  => 'date_range',
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'posted_at', '>=', $dates->from);
                $this->crud->addClause('where', 'posted_at', '<=', $dates->to . ' 23:59:59');
            });
        //status filter
        $this->crud->addFilter([
            'name'  => 'status',
            'label' => trans('blog.post.status'),
            'type'  => 'dropdown',
            ],
            BlogPost::getTypeStatus(),
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'status', $value ); });

        // daterange filter
        $this->setFilterDateUpdate();

    }
    
    public function clone($id)
    {
        $this->crud->hasAccessOrFail('clone');

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();
    // whatever you want
        $clonedEntry->title = $clonedEntry->title .' ' .'[clone]';

        return (string) $clonedEntry->push();
    }

    public function fetchCategory()
    {
        return $this->fetch('App\Models\BlogCategory');
        //return $this->fetch(App\Models\BlogCategory::class);
    }

    public function fetchTags()
    {
        return $this->fetch('App\Models\BlogTag');
        //return $this->fetch(App\Models\BlogTag::class);
    }

}
