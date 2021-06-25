@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	<section class="container-fluid d-print-none">
	<!--
    	<a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i>Imprimir</a> 

		<a href="#" onclick="$('#reportsTable').tableExport({type:'csv',escape:'false'});">CSV</a> 
		<a href="#" onclick="$('#reportsTable').tableExport({type:'txt',escape:'false'});">TXT</a> 
									
			<a class="btn btn-primary" href="{{ url($crud->route.'/pdf') }}">Export to PDF</a>
			<a href="#" onclick="$('#reportsTable').tableExport({type:'excel',escape:'false'});">Excel</a>
			<a href="#" onclick="$('#reportsTable').tableExport({type:'doc',escape:'false'});">Word</a> 
			<a href="#" onclick="$('#reportsTable').tableExport({type:'png',escape:'false'});">Imagen</a> 
			<a href="#" onclick="$('#reportsTable').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">PDF</a>
		-->						

		<h2>
	        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
	        <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}.</small>
	        @if ($crud->hasAccess('list'))
	          <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
	        @endif
	    </h2>

    </section>
@endsection

@section('content')
<div class="row">
	<div class="{{ $crud->getShowContentClass() }}">

	<!-- Default box -->
	  <div class="">
	  	@if ($crud->model->translationEnabled())
			<div class="row">
				<div class="col-md-12 mb-2">
					<!-- Change translation button group -->
					<div class="btn-group float-right">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[request()->input('locale')?request()->input('locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						@foreach ($crud->model->getAvailableLocales() as $key => $locale)
							<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?locale={{ $key }}">{{ $locale }}</a>
						@endforeach
					</ul>
					</div>
				</div>
			</div>
	    @endif
	    <div class="card no-padding no-border">

			<table id ="reportsTable" class="table table-striped mb-0">
          @php $columnas = $crud->columns(); @endphp
					<thead>
	          <tr>  
	            <td colspan="4" width="20%" align="center"> <img src="/img/idd-logo.png" height="60"> </td>
	            @php $column = $columnas["title"]; @endphp
	            <td colspan="3" align="center" valign="middle"> <h1><strong>{!! $column['label'] !!}</strong></h1></td>
	          </tr>
		    </thead>

		    <tbody>
				  


	            <tr>
		            @php $column = $columnas["id"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
								@php $column = $columnas["names__data14"]; @endphp
							  @if (data_get($entry, $column['name']) !="")
							  	<td rowspan="5" colspan="2" align="center">	@include('crud::columns.'.$column['type']) </td> 
							  @else
		            	<td rowspan="5" colspan="2"> &nbsp </td>
							  @endif	
							</tr>

							<tr>
		            @php $column = $columnas["display_name"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["sex_id"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["nationality_id"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["documents__data1"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

		          <tr>
		            @php $column = $columnas["events__data1"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
		            @php $column = $columnas["status"]; @endphp
		            <td width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["phones"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td colspan="3">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["emails"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td colspan="3">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

	            <tr>
		            @php $column = $columnas["addresses"]; @endphp
		            <td colspan="4"  width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td colspan="3">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

							<tr>
		            @php $column = $columnas["bloods__data2"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
		            @php $column = $columnas["bloods__data1"]; @endphp
		            <td width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>

		          <tr>
		            @php $column = $columnas["civil_status"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
		            @php $column = $columnas["spouse"]; @endphp
		            @if (data_get($entry, $column['name']) !="")
		            	<td width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  	<td width="30%">	@include('crud::columns.'.$column['type']) </td> 
								@else
		            	<td width="20%"> &nbsp </td>
							  	<td width="30%"> &nbsp </td> 
							  @endif	
							</tr>

							<tr>
		            @php $column = $columnas["baptisms"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
		            @php $column = $columnas["baptisms__data4"]; @endphp
		            @if (data_get($entry, $column['name']) !="")
		            	<td width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  	<td width="30%">	@include('crud::columns.'.$column['type']) </td> 
								@else
		            	<td width="20%"> &nbsp </td>
							  	<td width="30%"> &nbsp </td> 
							  @endif	
							</tr>


								@php $column = $columnas["baptisms__data5"]; @endphp
		          	@if (data_get($entry, $column['name']) !="")
							<tr>
		            	<td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  	<td colspan="3">	@include('crud::columns.'.$column['type']) </td> 
 							</tr>
 								@endif


		          <tr>
		            @php $column = $columnas["created_at_by_user"]; @endphp
		            <td colspan="4" width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td>
		            @php $column = $columnas["updated_at_by_user"]; @endphp
		            <td width="20%"> <strong>{!! $column['label'] !!}:</strong> </td>
							  <td width="30%">	@include('crud::columns.'.$column['type']) </td> 
							</tr>



		        </tbody>
			<tfoot>
					<tr class="d-print-none">
						<td colspan="4" width="20%"> <strong>{{ trans('backpack::crud.actions') }}</strong> </td>
						<td colspan="3"> @include('crud::inc.button_stack', ['stack' => 'line']) </td>
					</tr>
		   </tfoot>     
			</table>

	    </div><!-- /.box-body -->
	  </div><!-- @php dump($columnas); @endphp /.box -->
				
	</div>
</div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string') }}">

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/> -->
@endsection

@section('after_scripts')
	<script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
	<script src="{{ asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="{{ asset('packages/jquery/dist/jquery.js') }}"></script> 
<script type="text/javascript" src="{{ asset('packages/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/jquery.base64.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/html2canvas.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/jspdf/libs/sprintf.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/jspdf/jspdf.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/jspdf/libs/base64.js') }}"></script>
<!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->


@endsection
