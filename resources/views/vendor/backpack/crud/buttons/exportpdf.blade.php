@php
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $full_url = "https://"; 
    } else {
        $full_url = "http://"; 
    }
        $full_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
@endphp

@if ($crud->hasAccess('show'))
	@if ($crud->actionIs('show'))
	<!-- Single button -->
		<a href="{{ url($crud->route.'/topdf?url='.$full_url) }}" class="btn btn-sm btn-link"><i class="la la-file-pdf"></i> {{ trans('backpack::crud.export.export') }} {{ trans('backpack::crud.export.pdf') }}</a>
	@endif
@endif
