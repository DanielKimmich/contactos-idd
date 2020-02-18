<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
			<!-- <small>Use the <span class="label label-default">details_row</span> functionality to show more information about the entry, when that information does not fit inside the table column.</small><br><br> -->
			@if($entry->phones->count() > 0)
				<strong>Phones:</strong> {{ $entry->phones->implode('data1', ', ') }} <br>
			@endif
			@if($entry->emails->count() > 0)
				<strong>Emails:</strong> {{ $entry->emails->implode('data1', ', ') }} <br>
			@endif
			@if($entry->addresses->count() > 0)
				<strong>Adresses:</strong> {{ $entry->addresses->implode('data1', ', ') }} <br>
			@endif
		</div>
	</div>
</div>
<div class="clearfix"></div>