{{-- regular object attribute --}}
<!--
USAGE:
    $this->crud->addColumn([
    'name' => 'name',
    'label' => 'Name',
    'type' => 'multi_text',
    'spacer' => '-', // defaults to a space but can assign a custom spacer type if you want them connected another way.
     'columns' => [
          'first_name',
          'last_name'
     ]
]);

END USAGE
-->
@php
	$value = '';
	$spacer = ' ';

	if(isset($column['spacer'])) {
		$spacer = $column['spacer'];
	}

	foreach($column['columns'] as $key => $column_name) {
		if($key == 0) {
			$value = data_get($entry, $column_name);
		} else {
			$value = $value.$spacer.data_get($entry, $column_name);
		}
	}

	if (is_array($value)) {
		$value = json_encode($value);
	}
@endphp

<span>
	{{ (array_key_exists('prefix', $column) ? $column['prefix'] : '').str_limit(strip_tags($value), array_key_exists('limit', $column) ? $column['limit'] : 50, "[...]").(array_key_exists('suffix', $column) ? $column['suffix'] : '') }}
</span>
