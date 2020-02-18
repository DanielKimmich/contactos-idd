
@if (count($companies) > 0)
	<table class="table table-striped" >
		<thead>
			<th>{{ trans('company.company_name') }}</th>
			<th>{{ trans('company.address') }}</th>
			<th>{{ trans('company.tin') }}</th>
			<th>{{ trans('company.trn') }}</th>
			<th>{{ trans('common.actions') }}</th>
		</thead>
		<tbody>

			@foreach ($companies as $company)
				<tr>
					<td class="vertical-align-middle">{{ $company->row_contact_id }}</td>
					<td class="vertical-align-middle font-12">
						{{ $company->mimetype }} <br/>
						{{ $company->mimetype }} 
					</td>
					<td class="vertical-align-middle">{{ $company->data1 }}</td>
					<td class="vertical-align-middle">{{ $company->data2 }}</td>
					<td class="vertical-align-middle">
						<a href="javascript:void(0)" data-company-id="{{ $company->id }}" class="btn btn-xs btn-default btn-delete-company">
							<i class="fa fa-trash"></i> {{ trans('common.delete') }}
						</a>
					</td>
				</tr>
			@endforeach

		</tbody>
	</table>
@else
	<div class="alert alert-info">
		{{ trans('company.no_companies') }}
	</div>
	
@endif

 <div class="col-md-12">
        listar lineas
        {{ dd($companies) }}
      
    </div>