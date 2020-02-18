@php
    // specify a unique id we can use to reference this field
    $uid = $field['name'];
    // by default use fields defined in the related crudPanel
 //   $field['fields'] = $field['fields'] ?? $field['crud']->getCreateFields();
    //get the current entries from the related crud
    $entries = $field['crud']->getEntries();
@endphp

<div class="row">
    <div class="col-md-12">
        <a href="javascript:void(0)" class="btn btn-primary add-phone-btn">
            <i class="fa fa-plus"></i> {{ trans('phone.add_phone') }}
        </a>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-12">
        <div id="{{$uid}}"></div>
    </div>
</div>

<!-- Add phone modal -->
<div class="add-phone-modal modal fade" role="dialog"> 
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus"></i> {{ trans('phone.add_phone') }}</h4>
        </div>
        <div id="add-phone-fields">
            <div class="modal-body">
              <input type="hidden" name="phone[client_id]" value="{{ $entry->id }}">
              <input type="hidden" name="phone[mimetype]" value="Phone">
 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="number">{{ trans('phone.number') }}:</label>
                        <input type="text" class="form-control" name="phone[data1]" id="number">
                    </div>

                    <div class="col-md-6">
                        <label for="type">{{ trans('phone.type') }}:</label>
                        <input type="text" class="form-control" name="phone[data2]" id="type">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="label">{{ trans('phone.label') }}:</label>
                <textarea name="phone[data3]" class="form-control" id="label" rows="3"></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.cancel') }}</button>
              <button type="button" class="btn btn-primary btn-add-phone">{{ trans('common.add') }}</button>
            </div>
        </div>
      </div>
    </div>
 </div> 

@push('crud_fields_styles')
    <!-- include select2 css-->
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select 2 Bootstrap theme -->
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('crud_fields_scripts')
    <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    @if (app()->getLocale() !== 'en')
    <script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
    @endif
    <script>
        // List client phones
        function getClientPhones(client_id = null) {
            $.ajax({
                url: '{{ route('getClientPhones') }}',
                type: 'POST',
                data: {
                    client_id: client_id
                },
            })
            .done(function(resp) {
                $('#client_phones').html(resp);
            })
            .fail(function(resp) {
                // Show error message
                $(function(){
                  new PNotify({
                    text: '{{ trans('common.error_occurred') }}',
                    type: 'error',
                    icon: false
                  });
                });
            });
        }

        // Open modal and init select2
        $(document).on('click', '.add-phone-btn', function () {
            $('.add-phone-modal').modal('show');

            $('.select2_field').select2({
                theme: "bootstrap"
            });
        });

        // Add new phone
        $(document).on('click', '.btn-add-phone', function (e) {
            $.ajax({
                url: '{{ route('addClientPhone') }}',
                type: 'POST',
                data: $('#add-phone-fields :input').serialize(),
            })
            .done(function(resp) {
                // Close modal
                $('.add-phone-modal').modal('hide');

                // Reload client phones
                getClientPhones({{ $entry->id }});

                // Show success message
                $(function(){
                  new PNotify({
                    text: '{{ trans('phone.phone_created') }}',
                    type: 'success',
                    icon: false
                  });
                });
            })
            .fail(function() {
                // Close modal
                $('.add-phone-modal').modal('hide');

                // Show error message
                $(function(){
                  new PNotify({
                    text: '{{ trans('common.error_occurred') }}',
                    type: 'error',
                    icon: false
                  });
                });
            });
        });

        // Delete phone
        $(document).on('click', '.btn-delete-phone', function (){
            var confirmation = confirm("{{ trans('phone.delete_phone_confirm') }}");
            if (confirmation) {
                var phoneId = $(this).data('phone-id');

                $.ajax({
                    url: '{{ route('deleteClientPhone') }}',
                    type: 'POST',
                    data: {
                        id: phoneId,
                    },
                })
                .done(function() {
                    // Reload client phones
                    getClientPhones({{ $entry->id }});

                    // Show success message
                    $(function(){
                      new PNotify({
                        text: '{{ trans('phone.phone_deleted') }}',
                        type: 'success',
                        icon: false
                      });
                    });
                })
                .fail(function() {
                    // Show error message
                    $(function(){
                      new PNotify({
                        text: '{{ trans('common.error_occurred') }}',
                        type: 'error',
                        icon: false
                      });
                    });
                });

            }
        });

        $(document).ready(function () {
            // List client phones
            getClientPhones({{ $entry->id }});
        });
    </script>
@endpush