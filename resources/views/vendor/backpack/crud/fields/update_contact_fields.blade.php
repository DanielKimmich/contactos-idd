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
          $(document).on('keyup', '#namedata2', function() { setFullName();
          });

          $(document).on('keyup', '#namedata3', function() { setFullName();
          });

          $(document).on('keyup', '#namedata5', function() { setFullName();
          });


      function setFullName() {
          var name = $('#namedata2').val();
          var family = $('#namedata3').val();
          var middle = $('#namedata5').val();
          var data1 = $('#namedata1');
          data1.val( name +" "+ middle +" "+ family );
          var display_name = $('input[name="display_name"]');
          display_name.val(data1.val());
      }

      </script>

    @endpush
@endif
