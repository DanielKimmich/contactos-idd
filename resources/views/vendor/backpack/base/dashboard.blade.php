@extends(backpack_view('blank'))

@php
	use \Carbon\Carbon;
	$dias = 7;
	$contactCount = App\Models\Contact::count();
	$contactCountNew = App\Models\Contact::whereDate('created_at', '>', Carbon::today()->addDays($dias*-1))->count();
	$contactDataCount = App\Models\ContactData::count();
	$contactDataCountUpdate = App\Models\ContactData::whereDate('updated_at', '>', Carbon::today()->addDays($dias*-1))->count();

//	$lastBirthDays = App\Models\ContactData::where('mimetype', 'Event')->first();
//	$lastBirthDaysAgo = Carbon::parse($lastBirthDays->data7)->diffInDays(Carbon::today());
	$hoy = Carbon::today();
	$ayer = Carbon::today()->addDays($dias*-1);	

	$widgets['before_content'][] = [
  		'type'         => 'alert',
  		'class'        => 'alert alert-primary mb-2',
  		'heading'      => 'Important information!',
  		'content'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti nulla quas distinctio veritatis provident mollitia error fuga quis repellat, modi minima corporis similique, quaerat minus rerum dolorem asperiores, odit magnam.',
  		'close_button' => true, // show close button or not
	];
	
	$widgets['before_content'][] = [
  		'type' 	=> 'div',
  		'class' => 'row',
  		'content' => [ // widgets 
    		[ 	'type' => 'card', 
      			'class' => 'card bg-info text-white', 
      			'content' => [
      				'header' => 'Proximos Cumpleaños', 
      				'body' => 'One' // .$lastBirthDaysAgo.' days',
      			] 
    		],
      		[	'type' 	=> 'card', 
      			'class' => 'card bg-success text-white', 
      			'content' => [
      				'header' => 'Proximos Cumpleaños',
      				'body' => 'Hoy '. $hoy ?? '',
      			] 
      		],
      		[ 	'type' 	=> 'card', 
      			'class' => 'card bg-dark text-white', 
      			'content' => [
      				'header' => 'Proximos Cumpleaños',
      				'body' => 'Three ' .$ayer ?? '',
      			] 
      		],
  		] 
  	];

	$widgets['before_content'][] = [
  		'type' 	=> 'div',
  		'class' => 'row',
  		'content' => [ // widgets 
    		[ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-success mb-2',
    			'value'       => $contactCountNew,
    			'description' => 'Nuevos Contactos' .' en los ultimos ' .$dias. ' días',
    			'progress'    => floor($contactCountNew/$contactCount*100), // integer
    			'hint'        => 'de un total de ' .$contactCount .' registros',
    		],
      		[	'type'        => 'progress',
    			'class'       => 'card text-white bg-primary mb-2',
    			'value'       => $contactdataCountUpdate,	
    			'description' => 'Datos Actualizados ' .' en los ultimos ' .$dias. ' días',
    			'progress'    => floor($contactDataCountUpdate/$contactDataCount*100), // integer
    			'hint'        => 'de un total de ' .$contactDataCount .' registros',
      		],
      		[ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-danger mb-2',
    			'value'       => '11.456',
    			'description' => 'Registered users.',
    			'progress'    => 40, // integer
    			'hint'        => '8544 more until next milestone.',
      		],
            [ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-dark mb-2',
    			'value'       => '11.456',
    			'description' => 'Registered users.',
    			'progress'    => 40, // integer
    			'hint'        => '8544 more until next milestone.',
      		],
  		] 
  	];

/*
	$widgets['before_content'][] =
    	[
    	'type'        => 'progress',
    	'class'       => 'card text-white bg-primary mb-2',
    	'value'       => '11.456',
    	'description' => 'Registered users.',
    	'progress'    => 57, // integer
    	'hint'        => '8544 more until next milestone.',
		];
$widgets['before_content'][] =
[
    'type'        => 'progress_white',
    'class'       => 'card mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 57, // integer
    'progressClass' => 'progress-bar bg-primary',
    'hint'        => '8544 more until next milestone.',
];

	$widgets['before_content'][] =	
        [
  		'type' => 'card',
  		// 'wrapperClass' => 'col-sm-6 col-md-4', // optional
  		 'class' => 'card bg-dark text-white', // optional
  		'content' => [
      	'header' => 'Some card title', // optional
      	'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non mi nec orci euismod venenatis. Integer quis sapien et diam facilisis facilisis ultricies quis justo. Phasellus sem <b>turpis</b>, ornare quis aliquet ut, volutpat et lectus. Aliquam a egestas elit. <i>Nulla posuere</i>, sem et porttitor mollis, massa nibh sagittis nibh, id porttitor nibh turpis sed arcu.',
  		]
    	];

	$widgets['before_content'][] = [
        'type' => 'card',
        'wrapperClass' => 'col-sm-6 col-md-4',
        'content' => [
            'header' => 'Some card title',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non mi nec orci euismod venenatis. Integer quis sapien et diam facilisis facilisis ultricies quis justo. Phasellus sem <b>turpis</b>.',
        ],
    ];	



    $widgets['before_content'][] = 
    	[
        'type'        => 'jumbotron',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    	]; 

   */
@endphp

@section('content')
@endsection