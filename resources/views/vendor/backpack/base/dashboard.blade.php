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
    use Illuminate\Support\Facades\Config;

	//$dias = 7;
    $dias = (int)Config::get('settings.panel_day');
    $show_age = false;
    $today     = Carbon::today();
    $todayMMDD = Carbon::today()->format('m-d');
    $fromMMDD  = Carbon::today()->subDays($dias)->format('m-d');
	$toMMDD    = Carbon::today()->addDays($dias)->format('m-d');

//dump($todayMMDD, $fromMMDD, $toMMDD);

//Cumpleaños
	$births = ContactEvent::where('data2', 'TYPE_BIRTHDAY')
                ->whereNull('data4')
                ->where(\DB::raw("substr(data1, 6,5)"),">=", $fromMMDD)
                ->where(\DB::raw("substr(data1, 6,5)"),"<=", $toMMDD)
                ->orderBy(\DB::raw("substr(data1, 6,5)"), 'asc')
                ->get();

    $todaybirths = '';
    $nextbirths = '';
    $previousbirths = '';
  //  $arrbirths = [];

    foreach ($births as $birth)
    {   
        $birthday = substr($birth->data1, 5,5);
        $name  = $birth->display_name; 

        if ($birthday < $todayMMDD) {
            $age = $show_age ? ' (' .$birth->age .')' : '';
            $previousbirths .= $birthday .' ' .$name .$age .'<br>';
        } else if ($birthday > $todayMMDD) {
            $age = $show_age ? ' (' .((int)($birth->age) +1) .')' : '';
            $nextbirths .= $birthday .' ' .$name .$age .'<br>';
        }  else {
            $age = $show_age ? ' (' .$birth->age .')' : '';
            $todaybirths .= $birthday .' ' .$name .$age .'<br>';
        }

/*        if ($birthday < $todayMMDD) {
            $previousbirths .= $birthday .' ' .$name .' (' .$age .')<br>';
        } else if ($birthday > $todayMMDD) {
            $nextage = (int)($age) +1;
            $nextbirths .= $birthday .' ' .$name .' (' .$nextage  .')<br>';
        }  else {
            $todaybirths .= $birthday .' ' .$name .' (' .$age .')<br>';
        } 
*/
    }

 //   $arrbirths = $arrbirths->sortBy('birth');

//dump($arrbirths);
//dump($previousbirths);
//dump($nextbirths);
//dump($todaybirths);

    $widgets['before_content'][] = [
  		'type' 	=> 'div',
  		'class' => 'row',
  		'content' => [ // widgets 
    		[ 	'type' => 'card_copy', 
      			'class' => 'card bg-info text-white', 
      			'content' => [
      				'header' => trans('dashboard.birthday.today'),
              //'Cumpleaños de Hoy', 
      				'body' => $todaybirths,
      			] 
    		],
      		[	'type' 	=> 'card_copy', 
      			'class' => 'card bg-success text-white', 
      			'content' => [
      				'header' => trans('dashboard.birthday.next', ['day' => $dias]),
              //'Cumpleaños en los próximos ' .$dias. ' días',
      				'body' => $nextbirths,
      			] 
      		],
      		[ 	'type' 	=> 'card_copy', 
      			'class' => 'card bg-dark text-white', 
      			'content' => [
      				'header' => trans('dashboard.birthday.previous', ['day' => $dias]),
              //'Cumpleaños de los últimos ' .$dias. ' días',
      				'body' => $previousbirths,
      			] 
      		],
  		] 
  	];



//Contadores
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
    			'value'       => $contactPersonCountNew,
    			'description' => trans('dashboard.dataprogress.new_person'), //'nuevas Personas',
    			'progress'    => $contactProgress, // integer
    			'hint'        => trans('dashboard.dataprogress.hint', ['day' => $dias]),
          //'en los últimos ' .$dias. ' días',
    		],
      		[	'type'        => 'progress',
    			'class'       => 'card text-white bg-primary mb-2',
    			'value'       => $contactDataCountUpdate,	
    			'description' => trans('dashboard.dataprogress.update_data'), //'Datos editados',
    			'progress'    => $contactDataProgress, // integer
    			'hint'        => trans('dashboard.dataprogress.hint', ['day' => $dias]),
          // 'icon'        => 'la la-star-o',
          //'en los últimos ' .$dias. ' días',
      		],
      		[ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-danger mb-2',
    			'value'       => $blogPostCountNew,
    			'description' => trans('dashboard.dataprogress.new_post'), //'nuevas Historias',
    			'progress'    => $blogPostProgress, // integer
    			'hint'        => trans('dashboard.dataprogress.hint', ['day' => $dias]),
          //'en los últimos ' .$dias. ' días',
      		],
          [ 	'type'        => 'progress',
    			'class'       => 'card text-white bg-dark mb-2',
    			'value'       => $blogCommentCountNew,
    			'description' => trans('dashboard.dataprogress.new_comment'), //'nuevos Comentarios',
    			'progress'    => $blogCommentProgress, // integer
    			'hint'        => trans('dashboard.dataprogress.hint', ['day' => $dias]),
          //'en los últimos ' .$dias. ' días',
      		],
  		] 
  	];

//Notificaciones
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


   */
    $widgets['before_content'][] = 
    	[
        'type'        => 'jumbotron',
        'heading'     => trans('dashboard.email.heading'),
        'content'     => trans('dashboard.email.content'),
        'button_link' => backpack_url('sendmail'),
        'button_text' => trans('dashboard.email.button'),
    	]; 


@endphp

@section('content')
@endsection

