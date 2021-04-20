@if ($crud->hasAccess('updateperson'))
	@if (!$crud->actionIs('show'))
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactperson').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ trans('backpack::crud.edit') }}"> <i class="la la-id-card"></i>  </a>

	@else
	<!-- Single button -->
		<a href="{{ url(backpack_url('contactperson').'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link"><i class="la la-id-card"></i> {{ trans('backpack::crud.edit') }}</a>
	@endif
@endif