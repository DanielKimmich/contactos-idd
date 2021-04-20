@if ($crud->hasAccess('show'))
	@if (!$crud->actionIs('show'))
	<!-- Single button -->
		<a href="{{ url($crud->route.'/topdf') }}" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ trans('backpack::crud.preview') }}"> <i class="la la-file-pdf"></i>  </a>

	@else
	<!-- Single button -->
		<a href="{{ url($crud->route.'/topdf') }}" class="btn btn-sm btn-link"><i class="la la-file-pdf"></i> {{ trans('backpack::crud.preview') }}</a>
	@endif
@endif