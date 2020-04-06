@php
    // specify a unique id we can use to reference this field
    $uid = $field['type'].'_'.$field['name'];
    // by default use fields defined in the related crudPanel
    $field['fields'] = $field['fields']; // ?? $field['crud']->getCreateFields();
    //get the current entries from the related crud
    $entries = $field['crud']->getEntries();
    //$entries = $entry->phones ?? '';

@endphp

<div id="{{$uid}}">
    @include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>


    <div id="{{$uid}}-existing">
        @if(!empty($entries) && $entries->count() > 0)
            @foreach ($entries as $k => $relatedEntry)
                <div id="{{$uid}}related-entry-{{$relatedEntry->{$relatedEntry->getKeyName()} }}" class="container pt-3 {{$uid}}related-entry well" >
                    <div class="row"> 
                        <div class="col-md-12">
                            <div >
                                @if(!empty($entry))
                                <a class="btn btn-danger {{$uid}}-remove pull-left" related-field-id="{{$k}}" >
                                    <i class="la la-close"></i> 
                                    {{ trans('backpack::crud.delete') }} 
                                    {{ $field['crud']->entity_name }}
                                </a>
                                @endif
                            </div>
                        </div>

                        @php
                            $relationFields = $field['fields'];
                            foreach($relationFields as &$relationField){
                                $relationField['value'] = $relatedEntry->{$relationField['name']};
                                $relationField['column_name'] = $relationField['name'];
                                $relationField['name'] = $field['name'] ."[$k][". $relationField['name'] . "]";
                                $relationField['id'] = preg_replace('#[\[\]]+#', '', $relationField['name']);  
                                //agregar atributo id
                        if(array_key_exists ('attributes' , $relationField )) {
                            $relationField['attributes'] = $relationField['attributes'] + ['id' =>  $relationField['id'] ];
                        } else {
                            $relationField['attributes'] = ['id' =>  $relationField['id'] ];
                        }  

                        if(array_key_exists ('data_source' , $relationField )) {
                            $pos = strrpos($relationField['data_source'], '/'); 
                            $url = substr($relationField['data_source'],0,$pos+1);
                            $str = substr($relationField['data_source'],$pos+1);
                            $rep = preg_replace('/'.$relationField['column_name'].'/', $str, $relationField['name']); 
                            $relationField['data_source'] = $url . $rep;
                     
                    //        dump($url);  
                    //        dump($str); 
                     //       dump($rep); 
                     //       dump($relationField['data_source']);  

                        }
    
                        if(array_key_exists ('dependencies' , $relationField )) {
                        //    dump($relationField['dependencies']);
                        


                        //    $relationField['dependencies'] = preg_replace('/'.$relationField['column_name'].'/', $relationField['dependencies'], $relationField['name']); 
                         //   dump('#'.$relationField['column_name'].'#');  
                        //    dump($relationField['dependencies']); 
                         //   dump($relationField['name']);   
                        }


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
                       
         //   dump($relationFields);      
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
            <div class="new-entry d-none container pt-3 well " id="{{$uid}}-new{{$i}}">
                <div class="row"> 
                    <div class="col-md-12">
                        <div >
                            <a class="btn btn-warning {{$uid}}-remove pull-left" related-field-id="{{$i}}">
                            <i class="la la-close"></i> 
                            {{ trans('backpack::crud.delete') }} 
                            {{ $field['crud']->entity_name }}
                        </a>
                    </div>
                </div>
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

                        if(array_key_exists ('attributes' , $newEntryField )) {
                            $newEntryField['attributes'] = $newEntryField['attributes'] + ['id' =>  $newEntryField['id'] ];
                        } else {
                            $newEntryField['attributes'] = ['id' =>  $newEntryField['id'] ];
                        }  

                        if(array_key_exists ('data_source' , $newEntryField )) {
                            $pos = strrpos($newEntryField['data_source'], '/'); 
                            $url = substr($newEntryField['data_source'],0,$pos+1);
                            $str = substr($newEntryField['data_source'],$pos+1);
                            $rep = preg_replace('/'.$newEntryField['column_name'].'/', $str, $newEntryField['name']); 
                            $newEntryField['data_source'] = $url . $rep;
                     
                    //        dump($url);  
                    //        dump($str); 
                     //       dump($rep); 
                     //       dump($relationField['data_source']);  

                        }

                        if(array_key_exists ('dependencies' , $newEntryField )) {
                         //   dump($newEntryField['dependencies']); 
                            foreach($newEntryField['dependencies'] as $j =>$dependenciesField){

                            //dump($newEntryField['dependencies']);
                            $newEntryField['dependencies'][$j] = preg_replace('/'.$newEntryField['column_name'].'/', $dependenciesField, $newEntryField['name']); 
                            }
                         //   dump('#'.$relationField['column_name'].'#');  
                         //   dump($newEntryField['dependencies']); 
                         //   dump($relationField['name']);   

                        }                        
                    //check if we have defined a relationFields specific template for this field type

                    $fieldsViewNamespace = $newEntryField['view_namespace'] ?? 'crud::fields';
                    if(view()->exists($fieldsViewNamespace.'.relationFields.'.$newEntryField['type'])){
                        $newEntryField['type'] = 'relationFields.'.$newEntryField['type'];
                    }
                }
 //       dump($newEntryField['name']); 
                @endphp

                @include('crud::inc.show_fields', ['fields' => $newEntryFields, 'crud' => (!empty($field['crud'])? $field['crud'] : $crud)])
                </div>
            </div>
       @endfor

    </div>
 

        <a id="{{$uid}}-add" class="btn btn-primary">
            <i class="la la-plus"></i> 
            {{ trans('backpack::crud.add') }} {{ $field['crud']->entity_name }}
        </a>
    @include('crud::fields.inc.wrapper_end') 
</div>

    
<!--   endif 


push('after_scripts') -->
@push('after_scripts')
    <script>
        $(document).ready(function() {

           //Agregar
            $('#{{$uid}}-add').click(function(e){
                e.preventDefault();
                @if(!empty($entry))
                    var relatedFieldId = parseInt($('#{{$uid}}-new .d-none:first .{{$uid}}-remove').attr('related-field-id'));
                    var field = "{{ $field['name'] ."["}}" + relatedFieldId + "{{"][" .$field['foreignKey'] ."]" }}";
                    var display_id = $('input[name="' + field + '"]');
                    display_id.val({{ $entry->getKey() }});                 
                @endif
                $('#{{$uid}}-new .d-none:first').removeClass('d-none');
                if(!$('#{{$uid}}-new .d-none').length){
                    $(this).addClass('d-none');
                }
            });

            $('form').submit(function(){
                $('#{{$uid}}-new .d-none').remove();
            });


            //Eliminar Dato Existente
            @if(!empty($entry))
                $('#{{$uid}}-existing .{{$uid}}-remove').click(function(){
                    var relatedFieldId = parseInt($(this).attr('related-field-id'));
                    var field = "{{ $field['name'] ."["}}" + relatedFieldId + "{{"][" .$field['foreignKey'] ."]" }}";
                    var display_id = $('input[name="' + field + '"]');
                    display_id.val('');

                    $(this).closest('.{{$uid}}related-entry').hide();
                    return false;
                });
            @endif

            //Eliminar Dato Agregado recientemente
            $('#{{$uid}}-new .{{$uid}}-remove').click(function(){
                var relatedFieldId = parseInt($(this).attr('related-field-id'));
                var field = "{{ $field['name'] ."["}}" + relatedFieldId + "{{"][" .$field['foreignKey'] ."]" }}";
                var display_id = $('input[name="' + field + '"]');
                    display_id.val('');
                $(this).closest('.new-entry').addClass('d-none');
                $('#{{$uid}}-add').removeClass('d-none'); 
                return false;
            });

        });
    </script>
@endpush