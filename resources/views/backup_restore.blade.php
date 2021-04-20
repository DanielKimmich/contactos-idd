@extends(backpack_view('layouts.top_left'))

@php
  $breadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    trans('backpack::backup.backup') => false,
  ];
@endphp

@section('header')
    <section class="container-fluid">
      <h2>
        <span class="text-capitalize">{{ trans('backup.backup') }}</span>
      </h2>
    </section>
@endsection

@section('content')
<!-- Default box -->
  <button id="createButton" href="{{ url(config('backpack.base.route_prefix', 'admin').'/backuprestore/create') }}" class="btn btn-primary ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="la la-copy"></i> {{ trans('backup.create_a_new_backup') }}</span></button>

<form action="{{ url(config('backpack.base.route_prefix', 'admin').'/backuprestore/upload') }}" method="post" style="display: none" id="uploadForm">
    {{  csrf_field() }} 
    <input type="file" id="uploadInput" name="backupfile">
</form>

  <button id="uploadButton" class="btn btn-success ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="la la-upload"></i> {{ trans('backup.upload_a_new_backup') }}</span></button>

  <button id="downloadButton" class="btn btn-info ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="la la-download"></i> {{ trans('backup.download') }}</span></button>

  <button id="deleteButton" class="btn btn-danger ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="la la-trash-o"></i> {{ trans('backup.delete') }}</span></button>

  <button id="restoreButton" class="btn btn-warning ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="la la-redo-alt"></i> {{ trans('backup.restore_a_backup') }}</span></button>


  <div class="card">
    <div class="card-body p-0">
      <table id="backup_table" class="table table-striped table-hover nowrap rounded"> 
        <!-- class="table table-hover pb-0 mb-0"> -->
        <thead>
          <tr>
            <th>#</th>
            <th>{{ trans('backup.location') }}</th>
            <th>{{ trans('backup.file_name') }}</th>
            <th>{{ trans('backup.date') }}</th>
            <th class="text-right">{{ trans('backup.file_size') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($backups as $k => $b)
          <tr>
            <th scope="row">{{ $k+1 }}</th>
            <td>{{ $b['disk'] }}</td>
            <td>{{ $b['file_name'] }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}</td>
            <td class="text-right">{{ round((int)$b['file_size']/1048576, 2).' MB' }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-dt/css/jquery.dataTables.min.css') }}"> 
@endsection

@section('after_scripts')
 <script src="{{ asset('packages/jquery/dist/jquery.js') }}"></script> 
 <script src="{{ asset('packages/datatables.net/js/jquery.dataTables.min.js') }}"></script> 

<script>
  jQuery(document).ready(function($) {
    var $createButton = $('#createButton');
    var $uploadButton = $('#uploadButton');
    var $downloadButton = $('#downloadButton');
    var $deleteButton = $('#deleteButton');
    var $restoreButton = $('#restoreButton');

    var $uploadInput = $('#uploadInput');
    var $uploadForm = $('#uploadForm');
    var $data_row = [];
    var $data_table = $('#backup_table').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
    } ); 

    $downloadButton.attr('disabled','disabled');
    $deleteButton.attr('disabled','disabled');
    $restoreButton.attr('disabled','disabled');

    
    $('#backup_table tbody').on('click', 'tr', function () {
       // $(this).toggleClass('selected');
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $data_row = [];
            $downloadButton.attr('disabled','disabled');
            $deleteButton.attr('disabled','disabled');
            $restoreButton.attr('disabled','disabled');
        }
        else {
            $data_table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $data_row = $data_table.row( this ).data();
            $downloadButton.removeAttr('disabled');
            $deleteButton.removeAttr('disabled');
            $restoreButton.removeAttr('disabled');
        }
    } );
 
     

//Botton Create
    $createButton.on('click', function (e) {
        e.preventDefault();

        var $create_backup_url = "{{ url(config('backpack.base.route_prefix', 'admin').'/backuprestore/create') }}"

        if (confirm("{{ trans('backup.create_confirm') }}") == true) {
        // do the backup through ajax
            var ajax = $.ajax({
                url: $create_backup_url,
                type: 'PUT',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            });

            ajax.done(function (result) {            
           // success: function(result) {
                // Show an alert with the result
               // if (result.indexOf('failed') >= 0) {
                if (result == 'success') {
                    new Noty({
                        text: "<strong>{{ trans('backup.create_confirmation_title') }}</strong><br>{{ trans('backup.create_confirmation_message') }}",
                        type: "success"
                    }).show();
                    window.location.reload(); // Recargar página
                } else {
                    new Noty({
                        text: "<strong>{{ trans('backup.create_warning_title') }}</strong><br>{{ trans('backup.create_warning_message') }}",
                        type: "warning"
                    }).show();
                }
            });

            ajax.fail(function (jqXHR, textStatus, errorThrown) {
                jsonValue = jQuery.parseJSON( jqXHR.responseText );
                //error: function(result) {
                // Show an alert with the result
                new Noty({
                    text: "<strong>{{ trans('backup.create_error_title') }}</strong><br>{{ trans('backup.create_error_message') }}<br>"+jsonValue.message,
                    type: "warning"
                }).show();
            });
        } else {
            new Noty({
                text: "<strong>{{ trans('backup.create_cancel_title') }}</strong><br>{{ trans('backup.create_cancel_message') }}",
                type: "info"
            }).show();
        }
    });

//Boton Upload
    $uploadButton.on('click', function () {
        $uploadInput.click();
    });


    $uploadInput.on('change', function () {
     //   alert('change');
        var $file = $uploadInput[0].value;
        var $allowedExtensions = /(.gz|.sql)$/i;
      
        if($allowedExtensions.exec($file)){
            var formData = new FormData();
            formData.append('backupfile', $uploadInput[0].files[0]);        
            var ajax = $.ajax({
                url: $uploadForm.attr('action') + '?' + $uploadForm.serialize(),
                method: $uploadForm.attr('method'),
                data: formData,
                processData: false,
                contentType: false
            });

            ajax.done(function (data) {
                if (data.success) {
                    new Noty({
                        text: "<strong>{{ trans('backup.upload_confirmation_title') }}</strong><br>{{ trans('backup.upload_confirmation_message') }}" + data.message,
                        type: "success",
                        timeout: 4000
                    }).show();
                    window.location.reload(); // Recargar página
                } else {
                    new Noty({
                        text: "<strong>{{ trans('backup.upload_warning_title') }}</strong><br>{{ trans('backup.upload_error_message') }}",
                        type: "warning",
                        timeout: 4000
                    }).show();
                }
            });

            ajax.fail(function (jqXHR, textStatus, errorThrown) {
                jsonValue = jQuery.parseJSON( jqXHR.responseText );
              //  console.log(jsonValue.message);
                new Noty({
                    text: "<strong>{{ trans('backup.upload_warning_title') }}</strong><br>"+jsonValue.message,
                    type: "warning",
                    timeout: 4000,
                }).show();
            });
        } else {
            new Noty({
                text: "<strong>{{ trans('backup.upload_cancel_title') }}</strong><br>{{ trans('backup.upload_cancel_message') }}",
                    type: "warning",
            }).show();
        };

    });
 
//Botton Download
    $downloadButton.on('click', function () {
        var $disk = encodeURIComponent($data_row[1]);
        var $file_name = encodeURIComponent($data_row[2]);
   //     var $download_backup_url = "{ url(config('backpack.base.route_prefix', 'admin').'/backup/download/') }}?disk="+ $disk +"&path=" +$path+ "&file_name=" +$file_name;
       var $download_backup_url = "{{  url(config('backpack.base.route_prefix', 'admin').'/backuprestore/download/') }}" +"/" +$file_name;
       //?disk="+ $disk + "&file_name=" +$file_name;
     //   alert( 'You clicked on '+ $download_backup_url );

 


        window.location=$download_backup_url;
    });

//Boton Delete
    $deleteButton.on('click', function (e) {
        e.preventDefault();
        var $disk = encodeURIComponent($data_row[1]);
        var $file_name = encodeURIComponent($data_row[2]);
        var $delete_backup_url="{{ url(config('backpack.base.route_prefix', 'admin').'/backuprestore/delete/') }}" +"/" +$file_name;

        if (confirm("{{ trans('backup.delete_confirm') }}") == true) {
            var ajax = $.ajax({
                url: $delete_backup_url,
                type: 'DELETE',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            });

            ajax.done( function(result) {
                // Show an alert with the result
                new Noty({
                    text: "<strong>{{  trans('backup.delete_confirmation_title') }}</strong><br>{{  trans('backup.delete_confirmation_message') }}",
                    type: "success"
                }).show();
                // delete the row from the table
                $data_table.$('tr.selected').remove();
            });
            
            ajax.fail( function(jqXHR, textStatus, errorThrown) {
                // Show an alert with the result
                jsonValue = jQuery.parseJSON( jqXHR.responseText );
                if (jqXHR.status == 404) {
                    new Noty({
                        text: "<strong>{{  trans('backup.delete_error_title') }}</strong><br>{{ trans('backup.backup_doesnt_exist') }}",
                        type: "warning"
                    }).show();
                } else {
                    new Noty({
                        text: "<strong>{{ trans('backup.delete_error_title') }}</strong><br>{{ trans('backup.delete_error_message') }}<br>"+jsonValue.message,
                        type: "warning"
                    }).show();
                }
            });
        } else {
            new Noty({
                text: "<strong>{{ trans('backup.delete_cancel_title') }}</strong><br>",
                type: "info"
            }).show();

        }
    });

//Boton Restore
    $restoreButton.on('click', function (e) {
      //  alert( 'You clicked on' );
        e.preventDefault();
        var $disk = encodeURIComponent($data_row[1]);
        var $file_name = encodeURIComponent($data_row[2]);
        var $restore_backup_url = "{{  url(config('backpack.base.route_prefix', 'admin').'/backuprestore/restore/') }}" +"/" +$file_name;
        if (confirm("{{ trans('backup.restore_confirm') }}") == true) {
        // do the backup through ajax
            var ajax = $.ajax({
                url: $restore_backup_url,
                type: 'PUT',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            });

            ajax.done(function (result) {            
           // success: function(result) {
                // Show an alert with the result
                if (result == 'success') {
                    new Noty({
                        text: "<strong>{{ trans('backup.restore_confirmation_title') }}</strong><br>{{ trans('backup.restore_confirmation_message') }}",
                        type: "success"
                    }).show();
                } else {
                    new Noty({
                        text: "<strong>{{ trans('backup.restore_warning_title') }}</strong><br>{{ trans('backup.restore_warning_message') }}",
                        type: "warning"
                    }).show();
                }
            });

            ajax.fail(function (jqXHR, textStatus, errorThrown) {
                jsonValue = jQuery.parseJSON( jqXHR.responseText );
            //error: function(result) {
                // Show an alert with the result
                new Noty({
                    text: "<strong>{{ trans('backup.restore_error_title') }}</strong><br>{{ trans('backup.restore_error_message') }}<br>"+jsonValue.message,
                    type: "warning"
                }).show();
            });
        } else {
            new Noty({
                text: "<strong>{{ trans('backup.restore_cancel_title') }}</strong><br>",
                type: "info"
            }).show();
        }

    });


  });
</script>
@endsection
