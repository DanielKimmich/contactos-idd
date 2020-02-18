@if (count($phones) > 0)
	<table class="table table-striped" >
		<thead>
			<th>{{ trans('phone.number') }}</th>
			<th>{{ trans('phone.type') }}</th>
			<th>{{ trans('phone.label') }}</th>	
			<th>{{ trans('phone.normalized') }}</th>
			<th>{{ trans('common.actions') }}</th>
		</thead>
		<tbody>
			@foreach ($phones as $phone)
				<tr>
					<td class="vertical-align-middle">{{ $phone->data1 }}</td>
					<td class="vertical-align-middle">{{ $phone->data2 }}</td>
					<td class="vertical-align-middle">{{ $phone->data3 }}</td>
					<td class="vertical-align-middle">{{ $phone->data4 }}</td>
					<td class="vertical-align-middle">
						<a href="javascript:void(0)" data-phone-id="{{ $phone->id }}" class="btn btn-xs btn-default btn-delete-phone">
							<i class="fa fa-trash"></i> {{ trans('common.delete') }}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-info">
		{{ trans('phone.no_phones') }}
	</div>
@endif