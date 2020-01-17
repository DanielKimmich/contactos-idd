@php
    // specify a unique id we can use to reference this field
    $uid = $field['type'].'_'.$field['name'];
    // by default use fields defined in the related crudPanel
    $field['fields'] = $field['fields'] ?? $field['crud']->getCreateFields();
    //get the current entries from the related crud
    $entries = $field['crud']->getEntries();
@endphp

<div id="{{$uid}}" @include('crud::inc.field_wrapper_attributes')>
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <div id="{{$uid}}-existing">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($entries) && $entries->count() > 0)
                    @foreach ($entries as $k => $relatedEntry)
                        <div id="{{$uid}}related-entry-{{$relatedEntry->{$relatedEntry->getKeyName()} }}" class="well {{$uid}}related-entry">
                            <div class="row">
                                <div class="col-md-11">
                                    @php
                                        $relationFields = $field['fields'];
                                        foreach($relationFields as &$relationField){
                                            $relationField['value'] = $relatedEntry->{$relationField['name']};
                                            $relationField['column_name'] = $relationField['name'];
                                            $relationField['name'] = $field['name'] ."[$k][". $relationField['name'] . "]";
                                            $relationField['id'] = preg_replace('#[\[\]]+#', '', $relationField['name']);
                                            //check if we have defined a relationFields specific template for this field type
                                            $fieldsViewNamespace = $relationField['view_namespace'] ?? 'crud::fields';
                                            if(view()->exists($fieldsViewNamespace.'.relationFields.'.$relationField['type'])){
                                                $relationField['type'] = 'relationFields.'.$relationField['type'];
                                            }
                                        }
                                        //add a hidden field for the ID of this field
                                        array_unshift($relationFields,[
                                            'type' => 'hidden',
                                            'value' => $relatedEntry->{$relatedEntry->getKeyName()},
                                            'name' => $field['name'] ."[$k][id]",
                                            'label' => 'id',
                                        ]);
                                    @endphp
                                    @include('crud::inc.show_fields', ['fields' => $relationFields, 'crud' => (!empty($field['crud'])? $field['crud'] : $crud)])
                                </div>
                                @if(!empty($entry))
                                    <div class="col-md-1">
                                        <a class="btn btn-default {{$uid}}-remove pull-right" related-entry-id="{{$relatedEntry->id}}">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    {{--<p>No results</p>--}}
                @endif
            </div>
        </div>
    </div>

    <div id="{{$uid}}-new">
        @for($i = $entries->count(); $i < $entries->count() + ($field['additional_fields_count'] ?? 3); ++$i)
        <div class="row new-entry {{(!old($field['name'].'.'.$i))? 'hidden' : '' }} well">
            <div class="col-md-11 ">
                @php
                    $newEntryFields = $field['fields'];
                    foreach($newEntryFields as &$newEntryField){
                        //we change the name to something like 'fields[0][field]', and some field types use
                        //isColumnNullable which expects only 'field'. So we will define 'column_name' and override
                        //fields to switch them to using this
                        $newEntryField['column_name'] = $newEntryField['name'];
                        //change the name so these fields are all nested in an array
                        $newEntryField['name'] = $field['name'] ."[".(+$i)."][". $newEntryField['name'] . "]";
                        //some fields use then name in form IDs and JS which causes problems when there are square
                        //brackets. So we will set an 'ID' attribute we can use when we override the field.
                        $newEntryField['id'] = preg_replace('#[\[\]]+#', '', $newEntryField['name']);
                        //check if we have defined a relationFields specific template for this field type
                        $fieldsViewNamespace = $newEntryField['view_namespace'] ?? 'crud::fields';
                        if(view()->exists($fieldsViewNamespace.'.relationFields.'.$newEntryField['type'])){
                            $newEntryField['type'] = 'relationFields.'.$newEntryField['type'];
                        }
                    }
                @endphp
                @include('crud::inc.show_fields', ['fields' => $newEntryFields, 'crud' => (!empty($field['crud'])? $field['crud'] : $crud)])
            </div>
            <div class="col-md-1">
                <a class="btn btn-default {{$uid}}-remove pull-right">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
        @endfor
    </div>

    <a id="{{$uid}}-add" class="btn btn-default">
        <i class="fa fa-plus"></i> Add a {{ str_singular($field['label']) }}
    </a>
</div>

@push('after_scripts')
    <script>
        $(document).ready(function() {
            $('#{{$uid}}-add').click(function(e){
                e.preventDefault();
                $('#{{$uid}}-new .row.hidden:first').removeClass('hidden');
                if(!$('#{{$uid}}-new .row.hidden').length){
                    $(this).addClass('hidden');
                }
            });
            $('form').submit(function(){
                $('#{{$uid}}-new .row.hidden').remove();
            });
            @if(!empty($entry))
                $('#{{$uid}}-existing .{{$uid}}-remove').click(function(){
                    var self = this;
                    var relatedEntryId = parseInt($(this).attr('related-entry-id'));
                    $.ajax({
                        type:'DELETE',
                        url: '{{ url($field['crud']->route) }}/' + relatedEntryId,
                        data: [],
                        success:function(data){
                            $(self).closest('.{{$uid}}related-entry').remove();
                            new PNotify({
                                title: 'entry removed',
                                text: 'entry removed',
                                type: 'success'
                            });
                        }
                    });
                    return false;
                });
            @endif
            $('#{{$uid}}-new .{{$uid}}-remove').click(function(){
                var self = this;
                $(this).closest('.new-entry').addClass('hidden');
                return false;
            });
        });
    </script>
@endpush