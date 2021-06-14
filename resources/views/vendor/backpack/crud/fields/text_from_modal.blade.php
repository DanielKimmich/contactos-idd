<!-- text input -->
@php
    $field['modal_class'] = $field['modal_class'] ?? 'modal-dialog';
   // $field['separate'] = $field['separate'] ?? ',';
    $separator = $field['separate'] ?? ',';
    $data = $field['value'] ?? '';
    $arraydata = explode($separator, $data);
  // dump($arraydata);
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    {{-- @if(isset($field['prefix']) || isset($field['suffix']))  --}}
        <div class="input-group"> 
    {{-- @endif --}}
         <button class="btn btn-light btn-sm" data-handle="remove" type="button" id="showModalForm_{{ $field['name'] }}" data-toggle="tooltip" title="{{ trans('backpack::crud.edit').' '.$field['label'] }}"><i class="la la-edit"></i></button>
        @if(isset($field['prefix'])) 
            <div class="input-group-prepend">
                <span class="input-group-text">{!! $field['prefix'] !!}</span>
            </div> 
        @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            id="text_{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            data-separate="{{ $separator }}"
            @include('crud::fields.inc.attributes')
        >
        @if(isset($field['suffix'])) 
            <div class="input-group-append">
                <span class="input-group-text">{!! $field['suffix'] !!}</span>
            </div> 
        @endif
        <button class="btn btn-light btn-sm" data-handle="remove" type="button" id="clearText_{{ $field['name'] }}" data-toggle="tooltip" title="{{ trans('backpack::crud.delete').' '.$field['label'] }}"><i class="la la-times"></i></button>

    {{-- @if(isset($field['prefix']) || isset($field['suffix']))  --}}
        </div> 
    {{-- @endif --}}


    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif


@include('crud::fields.inc.wrapper_end')


 {{-- Modal for edit --}}
@push('crud_fields_scripts')
<div class="modal fade" id="text-create-dialog" tabindex="0" role="dialog" aria-labelledby="{{ $field['name'] }}-text-create-dialog-label" aria-hidden="true">
    <div class="{{  $field['modal_class'] }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                {!! $crud->getSubheading() ?? trans('backpack::crud.edit').' '.$field['label'] !!}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body bg-light">
                <form method="post"
                id="{{ $field['name'] }}-text-create-form"
                action="#"
                onsubmit="return false"
                @if ($crud->hasUploadFields('create'))
                    enctype="multipart/form-data"
                @endif
                >
                {!! csrf_field() !!}

                @if (isset($field['fields']) && is_array($field['fields']) && count($field['fields']))
                <div class="card">
                    <div class="card-body row">

                    @foreach($field['fields'] as $i => $subfield)
                    @php
                        $subfield = $crud->makeSureFieldHasNecessaryAttributes($subfield);
                        $fieldViewNamespace = $subfield['view_namespace'] ?? 'crud::fields';
                        $fieldViewPath = $fieldViewNamespace.'.'.$subfield['type'];
                        $subfield['showAsterisk'] = false;
                        //Agregar id
                        if(array_key_exists ('attributes' , $subfield )) {
                            $subfield['attributes'] += ['id' =>  $subfield['name'] ];

                        } else {
                            $subfield['attributes'] = ['id' =>  $subfield['name'] ];
                        }  
                        //Setear el valor
                        $subfield['value'] = $arraydata[$i] ?? "";
                        if ($subfield['attributes']['return_value'] ?? '' == 'text') {   
                            $arr_options = $subfield['options'];
                          //  dump($arr_options);
                            $subfield['value'] = array_search($subfield['value'], $arr_options);
                        } 
                        

                    @endphp

                    @include($fieldViewPath, ['field' => $subfield])
                    @endforeach
     
                    </div>
                </div>
                @endif
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">{{trans('backpack::crud.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="saveButton" data-dismiss="modal">{{trans('backpack::crud.apply')}}</button>
            </div>
        </div>
    </div>
</div>

@endpush

@push('crud_fields_scripts')
    <script>
        $(document).on('click', '#showModalForm_{{ $field['name'] }}', function() { 
            $('#text-create-dialog').modal('show');
        });


        $("#showModalForm_{{ $field['name'] }}").click( function() {
           $('#text-create-dialog').modal('show');
        });

{{--        $("#clearTextForm").click( function() {
            $("#text_{{ $field['name'] }}").val('');
        });
--}}
        $("#cancelButton").click( function() {

        });

        $("#saveButton").click( function() {
            var values = "";
            var separator = "";
            var elements = document.getElementById("{{ $field['name'] }}-text-create-form").elements; 
           // console.log(elements);
                for (var i = 0, element; element = elements[i++];) { 
                    if (values.length > 0)
                        separator = $("#text_{{ $field['name'] }}").attr('data-separate');
                    if (element.type === "text") {
                    //    console.log(element.id);
                        values +=  separator + element.value;
                    }
                    if (element.type === "select-one") {
                        console.log(element);
                        id = element.id;
                        if ($('#'+id).attr('return_value') == "text")
                            values += separator + $('#'+id).find(':selected').text();
                        else
                            values += separator + $('#'+id).find(':selected').val();
                    }
                }
            $("#text_{{ $field['name'] }}").val(values);
        });



    </script>
@endpush
