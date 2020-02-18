@if (count($addresses) > 0)
	<table class="table table-striped" >
		<thead>
			<th>{{ trans('address.number') }}</th>
			<th>{{ trans('address.type') }}</th>
			<th>{{ trans('address.label') }}</th>	
			<th>{{ trans('address.normalized') }}</th>
			<th>{{ trans('common.actions') }}</th>
		</thead>
		<tbody>
			@foreach ($addresses as $address)
				<tr>
					<td class="vertical-align-middle">{{ $address->data1 }}</td>
					<td class="vertical-align-middle">{{ $address->data2 }}</td>
					<td class="vertical-align-middle">{{ $address->data3 }}</td>
					<td class="vertical-align-middle">{{ $address->data4 }}</td>
					<td class="vertical-align-middle">
						<a href="javascript:void(0)" data-address-id="{{ $address->id }}" class="btn btn-xs btn-default btn-delete-address">
							<i class="fa fa-trash"></i> {{ trans('common.delete') }}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-info">
		{{ trans('address.no_addresses') }}
	</div>
@endif