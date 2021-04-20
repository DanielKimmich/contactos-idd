@if ($crud->hasAccess('updatechurch'))
	@if (!$crud->actionIs('show'))
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactchurch').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ trans('backpack::crud.edit') }}"> <i class="la la-cross"></i>  </a>

	@else
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactchurch').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link"><i class="la la-cross"></i> {{ trans('backpack::crud.edit') }}</a>
	@endif
@endif