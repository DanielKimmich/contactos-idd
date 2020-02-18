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
        //NAME
        $(document).on('keyup', '#first_name', function() { 
            setFullName();
        });
        $(document).on('keyup', '#middle_name', function() { 
            setFullName();
        });
        $(document).on('keyup', '#family_name', function() { 
            setFullName();
        });

        //ADDRESS0
        $(document).on('keyup', '#contact_addresses0data4, #contact_addresses0data6, #contact_addresses0data9', function() { 
            setFullAddress('contact_addresses0');
        });
        $(document).on('change', '#contact_addresses0data7, #contact_addresses0data8, #contact_addresses0data10', function() { 
            setFullAddress('contact_addresses0'); 
        });

        //ADDRESS1
        $(document).on('keyup', '#contact_addresses1data4, #contact_addresses1data6, #contact_addresses1data9', function() { 
            setFullAddress('contact_addresses1');
        });
        $(document).on('change', '#contact_addresses1data7, #contact_addresses1data8, #contact_addresses1data10', function() { 
            setFullAddress('contact_addresses1'); 
        });

        //ADDRESS2
        $(document).on('keyup', '#contact_addresses2data4, #contact_addresses2data6, #contact_addresses2data9', function() { 
            setFullAddress('contact_addresses2');
        });
        $(document).on('change', '#contact_addresses2data7, #contact_addresses2data8, #contact_addresses2data10', function() { 
            setFullAddress('contact_addresses2'); 
        });

        //ADDRESS3
        $(document).on('keyup', '#contact_addresses3data4, #contact_addresses3data6, #contact_addresses3data9', function() { 
            setFullAddress('contact_addresses3');
        });
        $(document).on('change', '#contact_addresses3data7, #contact_addresses3data8, #contact_addresses3data10', function() { 
            setFullAddress('contact_addresses3'); 
        });

        //ADDRESS4
        $(document).on('keyup', '#contact_addresses4data4, #contact_addresses4data6, #contact_addresses4data9', function() { 
            setFullAddress('contact_addresses3');
        });
        $(document).on('change', '#contact_addresses4data7, #contact_addresses4data8, #contact_addresses4data10', function() { 
            setFullAddress('contact_addresses4'); 
        });


 //       $(document).on('keyup', '#contact_addresses0data6', function() { 
 //           setFullAddress('contact_addresses0');
 //       });
 //       $(document).on('keyup', '#contact_addresses0data9', function() { 
  //          setFullAddress('contact_addresses0');
  //      });
  //      $(document).on('change', '#contact_addresses0data7', function() { 
  //          setFullAddress('contact_addresses0'); 
  //      });
 //        $(document).on('change', '#contact_addresses0data8', function() { 
 //           setFullAddress('contact_addresses0');   
 //       });
 //       $(document).on('change', '#contact_addresses0data10', function() { 
  //          setFullAddress('contact_addresses0'); 
  //      });   

 /*       
        $('#contact_addresses0data7').on("change", function(e) { 
            setFullAddress('contact_addresses0'); 
        });
         $('#contact_addresses0data8').on("change", function(e) { 
            setFullAddress('contact_addresses0');   
        });
        $('#contact_addresses0data10').on("change", function(e) { 
            setFullAddress('contact_addresses0'); 
        });   
*/
        function setFullName() {
            $first = $('#first_name').val();
            $middle = $('#middle_name').val();
            $family = $('#family_name').val();
            //var name = $('input[name="name_first"]').val();
            //var family = $('input[name="name_family"]').val();
            //var middle = $('input[name="name_middle"]').val();
            $name =  $first.trim() +" "+ $middle.trim() +" "+ $family.trim();
            // $('input[name="data1"]').val(data1);
            //$('input[name="display_name"]').val(data1);
            $('#full_name').val($name);
            $('#display_name').val($name);
        }

        function setFullAddress($prefix) {
        //  var relation = 'direccion';
        //  var data1 = $('#direccion0data1"]');
            var calle = $('#' +$prefix +'data4').val();
            var barrio = $('#' +$prefix +'data6').val();
            var code = $('#' +$prefix +'data9').val();
            var ciudad = $('#' +$prefix +'data7').find(':selected').text();
            var prov = $('#' +$prefix +'data8').find(':selected').text();
            var pais = $('#' +$prefix +'data10').find(':selected').text();
            var direccion = calle.trim() +", "+ barrio.trim() +", "+ code.trim() +", "+ ciudad.trim() +", "+ prov.trim() +", "+ pais.trim() ;
         // $('input[name="contact_addresses[0][data1]"]').val(direccion);
            $('#' +$prefix +'data1').val(direccion);
      }


      </script>

    @endpush
@endif
