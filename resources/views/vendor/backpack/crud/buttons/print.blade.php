@if ($crud->hasAccess('show'))
	@if ($crud->actionIs('show'))
	<!-- Single button -->
		<a href="javascript: window.print();" class="btn btn-sm btn-link"><i class="la la-print"></i> {{ trans('backpack::crud.export.print') }}</a>
	@endif
@endif