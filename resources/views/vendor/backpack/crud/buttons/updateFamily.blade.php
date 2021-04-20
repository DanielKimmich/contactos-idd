@if ($crud->hasAccess('updatefamily'))
	@if (!$crud->actionIs('show'))
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactfamily').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ trans('backpack::crud.edit') }}"> <i class="la la-users"></i>  </a>

	@else
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactfamily').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link"><i class="la la-users"></i> {{ trans('backpack::crud.edit') }}</a>
	@endif
@endif