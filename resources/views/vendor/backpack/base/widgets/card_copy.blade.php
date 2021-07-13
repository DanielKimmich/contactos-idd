@php
	// preserve backwards compatibility with Widgets in Backpack 4.0
	$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-md-4';
	$rand_id = rand();
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'card' }}" id="{{ 'card_'.$rand_id }}">
		@if (isset($widget['content']))
			@if (isset($widget['content']['header']))
				<div class="card-header d-flex justify-content-between align-items-center">{!! $widget['content']['header'] !!}
	<!-- Single button --> 
		<a href="javascript:void(0)" style='color: white' class="btn btn-link btn-sm {{ 'btn-copy'.$rand_id }}" data-clipboard-target="{{ '#card_'.$rand_id }}" title="{{ trans('backpack::crud.export.copy') }}"><i class="la la-clipboard"></i></a>
				</div>
			@endif
			<div class="card-body">{!! $widget['content']['body'] !!}</div>
	  	@endif
	</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

{{-- Button Javascript --}}
<script type="text/javascript" src="{{ asset('packages/clipboard.js') }}"></script>

@push('after_scripts') 
<script>
	var clipboard = new ClipboardJS("{!!'.btn-copy'.$rand_id !!}");

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


