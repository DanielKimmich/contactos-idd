@if ($crud->hasAccess('create'))
<a href="javascript:void(0)" onclick="importTransaction(this)" class="btn btn-secondary" data-style="zoom-in">
<span class="ladda-label"><i class="la la-upload"></i>Import {{ $crud->entity_name }}</span></a>
@endif

@push('after_scripts')
<script>
 	function importTransaction(button) {
  	        new Noty({
	          type: "warning",
	          text: "<strong>Importar los datos</strong><br>"
	        }).show();

	      	return;

		//\Alert::add('info', 'This is a blue bubble.');
	}
	//href="{{ url($crud->route.'/import') }}"
</script>	
@endpush

