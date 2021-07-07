@if ($crud->hasAccess('show'))
	@if ($crud->actionIs('show'))
	<!-- Single button -->
		<a href="javascript:void(0)" class="btn btn-sm btn-link btn-copy" data-clipboard-target="#reportsTable"><i class="la la-copy"></i> {{ trans('backpack::crud.export.copy') }}</a>
	@endif
@endif

{{-- Button Javascript --}}
<script type="text/javascript" src="{{ asset('packages/clipboard.js') }}"></script>

@push('after_scripts') 
<script>
	var clipboard = new ClipboardJS('.btn-copy');

	clipboard.on('success', function (e) {
		// console.info('Action:', e.action);
		// console.info('Text:', e.text);
		//  console.info('Trigger:', e.trigger);
		e.clearSelection();
        // Show an alert with the result
        new Noty({
        	type: "success",
        	text: "{!! trans('common.copy_success') !!}"
        }).show();
    });

	clipboard.on('error', function (e) {
		console.error('Action:', e.action);
		console.error('Trigger:', e.trigger);
        // Show an alert with the result
        new Noty({
        	type: "warning",
        	text: "{!! trans('common.copy_failure') !!}"
        }).show();  
    });
</script>
@endpush
