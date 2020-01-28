@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
  {{-- FIELD EXTRA CSS  --}}
  {{-- push things in the after_styles section --}}

      @push('crud_fields_styles')
          <!-- no styles -->
      @endpush


  {{-- FIELD EXTRA JS --}}
  {{-- push things in the after_scripts section --}}

      @push('crud_fields_scripts')

     {{--   <script src="{{ asset('js/bigNumber.js') }}"></script>  --}}

        <script>
          var data1 = $('input[name="data1"]');
          var data3 = $('input[name="data3"]');
          var data4 = $('input[name="data4"]');
          var data2_value = 'valor inicial';
        //  var tabla = $('crud->entry');
          var label = '';
 
          $(document).on('keyup', 'input[name="data4"]', function() { setAddress();
          });

          $(document).on('keyup', 'input[name="data6"]', function() { setAddress();
          });

          $(document).on('keyup', 'input[name="data9"]', function() { setAddress();
          });

         // Calculate price without on selected tax change
          $('#tipo').select({ theme: "bootstrap"
                }).on("change", function(e) {
                var id = $(this).val();
                var texto = $(this).find(':selected').text() ;
                data3.val( id + texto );
               // setAddress();
                });

          // On select pais
          //$('#pais').select2({theme: "bootstrap"}).on("change", function(e) { 
              //   $('#prov').select2({theme: "bootstrap"}).val(null).trigger("change"); });
            $('#pais').on("change", function(e) { setAddress(); 
              });
          
           $('#select2_ajax_data8').on("change", function(e) { setAddress(); 
              }); 

            $('#select2_ajax_data7').on("change", function(e) { setAddress(); 
              });  

      function setAddress() {
          var data1 = $('input[name="data1"]');
          var calle = $('input[name="data4"]').val();
          var barrio = $('input[name="data6"]').val();
          var code = $('input[name="data9"]').val();
          var ciudad = $('#select2_ajax_data7').find(':selected').text();
          var prov = $('#select2_ajax_data8').find(':selected').text();
          var pais = $('#pais').find(':selected').text();
          // var pais = $('#pais').select2({theme: "bootstrap"}).find(':selected').text();
          data1.val( calle +", "+ barrio +", "+ code +", "+ ciudad +", "+ prov +", "+ pais );
      }




        </script>

      @endpush
@endif
  {{--
     //    data1.val({{ $crud->entry->types->findOrFail($id)->id }});
         //   data1.val({{ App\Models\ContentType::where('id', $id)->get()->id }});

funtion getLabel(id) {
$.get("api/getlabel/" + id, function (label) {
    $('input[name="data3"]').html(label);
})

}

         --}}