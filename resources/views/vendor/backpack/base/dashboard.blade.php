@extends(backpack_view('blank'))

@php

    use App\Models\Notification;
    use App\Models\ContactEvent;
    use App\Models\ContactPerson;
    use App\Models\ContactData;
    use App\Models\BlogPost;
    use App\Models\BlogComment;
    use \Carbon\Carbon;
    use Illuminate\Support\Str;

	$dias = 7;

    $notifications = App\Models\Notification::whereDate('expires_at', '>=', Carbon::today())->get();
    foreach ($notifications as $noti)
    {
        $widgets['before_content'][] = [
            'type'         => 'alert',
            'class'        => 'alert mb-2 alert-' .$noti->class_color,
            'heading'      => $noti->title,
            'content'      => $noti->body,
            'close_button' => true, // show close button or not
        ];    
    }

    $today     = Carbon::today();
    $todayMMDD = Carbon::today()->format('m-d');
    $fromMMDD  = Carbon::today()->subDays($dias)->format('m-d');
	$toMMDD    = Carbon::today()->addDays($dias)->format('m-d');

//dump($todayMMDD, $fromMMDD, $toMMDD);

	$births = ContactEvent::where('data2', 'TYPE_BIRTHDAY')
                ->whereNull('data4')
                ->where(\DB::raw("substr(data1, 6,5)"),">=", $fromMMDD)
                ->where(\DB::raw("substr(data1, 6,5)"),"<=", $toMMDD)
                ->get();

    $todaybirths = '';
    $nextbirths = '';
    $previousbirths = '';
    $arrbirths = [];

    foreach ($births as $birth)
    {   
        $birthday = substr($birth->data1, 5,5);
        $name  = $birth->display_name; 
        $age   = $birth->age;
        $arrbirths[] = ['birth' => $birthday, 'name'  => $name, 'age'   => $age];
        if ($birthday < $todayMMDD) {
            $previousbirths .= $birthday .' ' .$name .' (' .$age .')<br>';
        } else if ($birthday > $todayMMDD) {
            $nextage = (int)($age) +1;
            $nextbirths .= $birthday .' ' .$name .' (' .$nextage  .')<br>';
        }  else {
            $todaybirths .= $birthday .' ' .$name .' (' .$age .')<br>';
        }
    }
//dump($arrbirths);
//dump($previousbirths);
//dump($nextbirths);
//dump($todaybirths);

    $widgets['before_content'][] = [
  		'type' 	=> 'div',
  		'class' => 'row',
  		'content' => [ // widgets 
    		[ 	'type' => 'card', 
      			'class' => 'card bg-info text-white', 
      			'content' => [
      				'header' => 'Cumpleaños de Hoy', 
      				'body' => $todaybirths,
      			] 
    		],
      		[	'type' 	=> 'card', 
      			'class' => 'card bg-success text-white', 
      			'content' => [
      				'header' => 'Cumpleaños en los próximos ' .$dias. ' días',
      				'body' => $nextbirths,
      			] 
      		],
      		[ 	'type' 	=> 'card', 
      			'class' => 'card bg-dark text-white', 
      			'content' => [
      				'header' => 'Cumpleaños de los últimos ' .$dias. ' días',
      				'body' => $previousbirths,
      			] 
      		],
  		] 
  	];

    $contactPersonCount = ContactPerson::count();
    $contactPersonCountNew = ContactPerson::whereDate('created_at', '>', Carbon::today()->subDays($dias))->count();
    if ($contactPersonCount > 0) 
        $contactProgress = floor($contactPersonCountNew/$contactPersonCount*100);
    else 
        $contactProgress = 0;

    $contactDataCount = ContactData::count();
    $contactDataCountUpdate = ContactData::whereDate('updated_at', '>', Carbon::today()->subDays($dias))->count();
    if ($contactDataCount > 0) 
        $contactDataProgress = floor($contactDataCountUpdate/$contactDataCount*100);
    else 
        $contactDataProgress = 0;

    $blogPostCount = BlogPost::count();
    $blogPostCountNew = BlogPost::whereDate('created_at', '>', Carbon::today()->subDays($dias))->count();
    if ($blogPostCount  > 0) 
        $blogPostProgress = floor($blogPostCountNew/$blogPostCount*100);
    else 
        $blogPostProgress = 0;

    $blogCommentCount = BlogComment::count();
    $blogCommentCountNew = BlogComment::whereDate('updated_at', '>', Carbon::today()->subDays($dias))->count();
    if ($blogCommentCount > 0) 
        $blogCommentProgress = floor($blogCommentCountNew/$blogCommentCount*100);
    else 
        $blogCommentProgress = 0;

	$widgets['before_content'][] = [
  		'type' 	=> 'div',
  		'class' => 'row',
  		'content' => [ // widgets 
    		[ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-success mb-2',
    			'value'       => $contactPersonCountNew .' Contactos',
    			'description' => 'nuevos en los últimos ' .$dias. ' días',
    			'progress'    => $contactProgress, // integer
    			'hint'        => 'de un total de ' .$contactPersonCount .' registros',
    		],
      		[	'type'        => 'progress',
    			'class'       => 'card text-white bg-primary mb-2',
    			'value'       => $contactDataCountUpdate .' Datos',	
    			'description' => 'editados en los últimos ' .$dias. ' días',
    			'progress'    => $contactDataProgress, // integer
    			'hint'        => 'de un total de ' .$contactDataCount .' registros',
      		],
      		[ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-danger mb-2',
    			'value'       => $blogPostCountNew . ' Historias',
    			'description' => 'nuevas en los últimos ' .$dias. ' días',
    			'progress'    => $blogPostProgress, // integer
    			'hint'        => 'de un total de ' .$blogPostCount .' registros',
      		],
            [ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-dark mb-2',
    			'value'       => $blogCommentCountNew .' Comentarios',
    			'description' => 'nuevos en los últimos ' .$dias. ' días',
    			'progress'    => $blogCommentProgress, // integer
    			'hint'        => 'de un total de ' .$blogCommentCount .' registros',
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

