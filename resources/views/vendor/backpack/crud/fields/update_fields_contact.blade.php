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

        $(document).ready(function() {
            $status = $('#contact_status').find(':selected').val();
            if ($status != 'DEAD') {
                $('#event_dead').parents('.form-group').addClass('d-none');
            } 
        });

        //NAME
        $(document).on('keyup', '#name_first, #name_middle, #name_family', function() { 
            setFullName();
        });

        $('#inline-create-dialog').on('keyup', '#name_first, #name_middle, #name_family', function() { 
            setFullName();
        });

        //STATUS
        $(document).on('change', '#contact_status', function() { 
            setEventDead(); 
        });

        //ADDRESS0
//        $(document).on('change', '#address_country', function() { 
        //    console.log($('#address_country').val());
 //               setFullAddressData1();
  //      });

        $(document).on('keyup', '#contact_addresses0data4, #contact_addresses0data6, #contact_addresses0data9', function() { 
            setFullAddress('contact_addresses0');
        });
        $(document).on('change', '#contact_addresses0data7, #contact_addresses0data8, #contact_addresses0data10', function() { 
            setFullAddress('contact_addresses0'); 
        });

        //ADDRESS1
        $(document).on('keyup', '#address_street, #address_neigh, #address_postcode', function() { 
            setFullAddressData1();
        });
        $(document).on('change', '#address_country, #address_division, #address_city', function() { 
            setFullAddressData1(); 
        });

        //ADDRESS2
        $(document).on('keyup', '#contact_addresses2data4, #contact_addresses2data6, #contact_addresses2data9', function() { 
            setFullAddress('contact_addresses2');
        });
        $(document).on('change', '#contact_addresses2data7, #contact_addresses2data8, #contact_addresses2data10', function() { 
            setFullAddress('contact_addresses2'); 
        });


        function setFullName() {
            $first = $('#name_first').val();
            $middle = $('#name_middle').val();
            $family = $('#name_family').val();
            //var name = $('input[name="name_first"]').val();
            //var family = $('input[name="name_family"]').val();
            //var middle = $('input[name="name_middle"]').val();
            $name =  $first.trim() +" "+ $middle.trim() +" "+ $family.trim();
            // $('input[name="data1"]').val(data1);
          //  $('input[name="display_name"]').val($name);
            $('#display_name').val($name);
            $('#name_display').val($name);
        }

        function setEventDead() {
            $status = $('#contact_status').find(':selected').val();
            if ($status == 'DEAD') {
                $('#event_dead').parents('.form-group').removeClass('d-none');
                if ($('#inline-create-dialog').hasClass('show')) {
                    //alert("Modal is visible") #contactperson-
                    $tab="#inline_tab_{{ Str::slug(trans('contact.data')) }}"
                    $('#inline_form_tabs a[href="' +$tab+ '"]').tab('show');
                    //inline_form_tabs
                } else {
                    $tab="#tab_{{ Str::slug(trans('contact.data')) }}"
                    $('#form_tabs a[href="' +$tab+ '"]').tab('show');                    
                }
                $('#event_dead').focus();
            } else if ($('#event_dead').val() == '' ) {
                $('#event_dead').parents('.form-group').addClass('d-none');
            } else {
                if ($('#inline-create-dialog').hasClass('show')) {
                    //alert("Modal is visible") contactperson-
                    $tab="#inline_tab_{{ Str::slug(trans('contact.data')) }}"
                    $('#inline_form_tabs a[href="' +$tab+ '"]').tab('show');
                    //inline_form_tabs
                } else {
                    $tab="#tab_{{ Str::slug(trans('contact.data')) }}"
                    $('#form_tabs a[href="' +$tab+ '"]').tab('show');                    
                }
                swal({
                    title: "{!! trans('backpack::base.warning') !!}",
                    text: "{!! trans('contact.event.delete_confirm') !!}",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "{!! trans('backpack::crud.cancel') !!}",
                            value: null,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        delete: {
                            text: "{!! trans('backpack::crud.delete') !!}",
                            value: true,
                            visible: true,
                            className: "bg-danger",
                            closeModal: true,
                        }
                    },
                }).then((value) => {
                    if (value) {
                        $('#event_dead').val('');
                        $('#event_dead').parents('.form-group').addClass('d-none');
                    } else {
                        $('#contact_status').val('DEAD');
                    }
                });
            } 
        }

        function setFullAddressData1() {
            var calle = $('#address_street').val();
            var barrio = $('#address_neigh').val();
            var code = $('#address_postcode').val();
            var ciudad = $('#address_city').find(':selected').text();
            var prov = $('#address_division').find(':selected').text();
            var pais = $('#address_country').find(':selected').text();
            var direccion = calle.trim() +", "+ barrio.trim() +", "+ code.trim() +", "+ ciudad.trim() +", "+ prov.trim() +", "+ pais.trim() ;
         // $('input[name="contact_addresses[0][data1]"]').val(direccion);
          //  $('#' +$prefix +'data1').val(direccion);
          $('#address_data1').val(direccion);
    //      console.log($('#address_country').val());
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
