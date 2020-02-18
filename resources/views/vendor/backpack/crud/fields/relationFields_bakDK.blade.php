@php
    // specify a unique id we can use to reference this field
    $uid = $field['type'].'_'.$field['name'];
    // by default use fields defined in the related crudPanel
    $field['fields'] = $field['fields']; // ?? $field['crud']->getCreateFields();
    //get the current entries from the related crud
    $entries = $field['crud']->getEntries();
    //$entries = $field['crud'];
    //$entries = $entry->phones ?? '';
    $i = $entries->count();
    $j = $i;
@endphp

<div id="{{$uid}}" 
    @include('crud::inc.field_wrapper_attributes')>
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <div id="{{$uid}}-existing">
        @if(!empty($entries) && $entries->count() > 0)
            @foreach ($entries as $k => $relatedEntry)
                <div id="{{$uid}}related-entry-{{$relatedEntry->{$relatedEntry->getKeyName()} }}" class="container pt-3 {{$uid}}related-entry well" >
                    <div class="row">    
                        @if(!empty($entry))
                            <a class="btn btn-danger {{$uid}}-remove pull-right" related-field-id="{{$k}}" >
                            <i class="fa fa-close"></i> 
                            Del a {{ str_singular($field['label']) }}
                            </a>
                        @endif
                
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
                </div>
            @endforeach
        @else
                {{--<p>No results</p>--}}
        @endif
    </div>


    <div id="{{$uid}}-new">
   @for($i = $entries->count(); $i < $entries->count() + ($field['additional_fields_count'] ?? 3); ++$i)
            <div class="new-entry container pt-3 well " id="{{$uid}}-new{{$i}}">
                <div class="row"> 
                    <a class="btn btn-warning {{$uid}}-remove pull-right " related-field-id="{{$i}}">
                        <i class="fa fa-close"></i> 
                        Del a {{ str_singular($field['label']) }}
                    </a>

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
                   // $i++;
                    @endphp

                    @include('crud::inc.show_fields', ['fields' => $newEntryFields, 'crud' => (!empty($field['crud'])? $field['crud'] : $crud)])
                </div>
            </div>
       @endfor
    </div>
 

        <a id="{{$uid}}-add" class="btn btn-primary" related-field-id="{{$j}}">
            <i class="fa fa-plus"></i> 
            Add a {{ str_singular($field['label']) }}
        </a>

</div>
       
<!--   endif 


push('after_scripts') -->
@push('after_scripts')
    <script>
        $(document).ready(function() {
           var i=1;
           var wrapper = $('#dynamic_field'); //Campo de entrada
           //Agregar
            $('#{{$uid}}-add').click(function(e){
                e.preventDefault();
//i++;
//var fieldHTML = '<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Ingrese su nombre" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>';

             //   $('#Telefonos1contact_id').parent().parent().show();

               // $('#{{$uid}}-new').closest('#{{$uid}}-new1').removeClass('d-none');
                $('#{{$uid}}-new').children('#{{$uid}}-new1').addClass('d-none');




             //   var relatedFieldId = parseInt($(this).attr('related-field-id'));
              //  $('#{{$uid}}-new' + relatedFieldId).hide();
 

             //   $(this).attr('related-field-id').val(relatedFieldId+1);
               // var wrapper = $('.field_wrapper'); //Campo de entrada
               // $(wrapper).append(newField()); //Agrega campo html

                //    var display_data = $('input[name="Telefonos[0][contact_id]"]');
               //     display_data.val(field);
                //    display_data.val(fieldHTML);
      //  $(wrapper).append(fieldHTML);
            });

            $('form').submit(function(){
                $('#{{$uid}}-new .row.hidden').remove();
            });


            //Eliminar Dato Existente
            @if(!empty($entry))
                $('#{{$uid}}-existing .{{$uid}}-remove').click(function(){
                    var self = this;
                    var relatedFieldId = parseInt($(this).attr('related-field-id'));
                    //$(this).closest('.{{$uid}}-remove').hide();
                    

                    var field = "{{ $field['name'] ."["}}" + relatedFieldId + "{{"][" .$field['foreignKey'] ."]" }}";

                   var data = "{{ $field['name'] ."["}}" + relatedFieldId + '][data3]' ;
                    var display_data = $('input[name="' + data + '"]');
                    display_data.val(field);

                   // var display_id = $('input[name="Telefonos[0][contact_id]"]');
                   var display_id = $('input[name="' + field + '"]');
                    display_id.val('');
//console.log(data);
//console.log(field);

                  //  $(this).closest('.{{$uid}}related-entry').hide();
                    return false;
                });
            @endif

            //Eliminar Dato Agregado recientemente
            $('#{{$uid}}-new .{{$uid}}-remove').click(function(){
                var self = this;

                    var relatedFieldId = parseInt($(this).attr('related-field-id'));
                    var field = "{{ $field['name'] ."["}}" + relatedFieldId + "{{"][" .$field['foreignKey'] ."]" }}";

                   var data = "{{ $field['name'] ."["}}" + relatedFieldId + '][data3]' ;
                    var display_data = $('input[name="' + data + '"]');
                    display_data.val(field);
//display_data.val(newField());
               // $(this).closest('.new-entry').removeClass('d-none');
 
            //Tres formas de ocultar una clase
                $(this).closest('.new-entry').addClass('d-none');
             //   $(this).closest('.new-entry').hide();
             //   $(this).closest('#{{$uid}}-new' + relatedFieldId).hide();
                return false;
            });
        });

    function newField() {

 
  //var fieldHTML = '<div><input type="text" id="field_name" name="field_name[]" id="d" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img class="remove-icon" src="remove.png"/></a></div>'; //Nuevo campo html
    
    var fieldHTML = '<div><input type="text" id="field_name"</div>'; //Nuevo campo html

        return fieldHTML;
        }



    </script>
@endpush