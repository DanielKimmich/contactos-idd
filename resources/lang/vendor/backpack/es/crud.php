<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new'         => 'Guardar y crear nuevo',
    'save_action_save_and_edit'        => 'Guardar y continuar editando',
    'save_action_save_and_back'        => 'Guardar y regresar',
    'save_action_save_and_preview'     => 'Guardar y vista previa',
    'save_action_changed_notification' => 'La acción por defecto del botón guardar ha sido modificada.',

    // Create form
    'add'                 => 'Añadir',
    'back_to_all'         => 'Volver al listado de',
    'cancel'              => 'Cancelar',
    'add_a_new'           => 'Añadir ',

    // Edit form
    'edit'                 => 'Editar',
    'save'                 => 'Guardar',

    // Revisions
    'revisions'            => 'Las revisiones',
    'no_revisions'         => 'No hay revisiones encontradas',
    'created_this'         => 'creado este',
    'changed_the'          => 'cambiado el',
    'restore_this_value'   => 'Restaurar este valor',
    'from'                 => 'de',
    'to'                   => 'a',
    'undo'                 => 'Deshacer',
    'revision_restored'    => 'Revisión restaurada correctamente',
    'guest_user'           => 'Usuario invitado',

    // Translatable models
    'edit_translations' => 'EDITAR TRADUCCIONES',
    'language'          => 'Idioma',

    // CRUD table view
    'all'                       => 'Todos',
    'in_the_database'           => 'en la base de datos',
    'list'                      => 'Listar',
    'reset'                     => 'Reiniciar',
    'actions'                   => 'Acciones',
    'preview'                   => 'Ver',
    'delete'                    => 'Eliminar',
    'admin'                     => 'Admin',
    'details_row'               => 'Esta es la fila de detalles. Modificar a su gusto.',
    'details_row_loading_error' => 'Se ha producido un error al cargar los datos. Por favor, intente de nuevo.',
    'clone' => 'Clonar',
    'clone_success' => '<strong>Entry cloned</strong><br>A new entry has been added, with the same information as this one.',
    'clone_failure' => '<strong>Cloning failed</strong><br>The new entry could not be created. Please try again.',

    // Confirmation messages and bubbles
    'delete_confirm'                              => '¿Está seguro que desea eliminar este elemento?',
    'delete_confirmation_title'                   => 'Elemento eliminado',
    'delete_confirmation_message'                 => 'El elemento ha sido eliminado de manera correcta.',
    'delete_confirmation_not_title'               => 'No se pudo eliminar',
    'delete_confirmation_not_message'             => 'Ha ocurrido un error. Puede que el elemento no haya sido eliminado.',
    'delete_confirmation_not_deleted_title'       => 'No se pudo eliminar',
    'delete_confirmation_not_deleted_message'     => 'No ha ocurrido nada. Su elemento está seguro.',

    // Bulk actions
    'bulk_no_entries_selected_title'   => 'No hay registros seleccionados',
    'bulk_no_entries_selected_message' => 'Seleccione uno o más registros en los que realizar la operación',

    // Bulk confirmation
    'bulk_delete_are_you_sure'   => '¿Estás seguro de que deseas eliminar :number registro/s?',
    'bulk_delete_sucess_title'   => 'Registros eliminados',
    'bulk_delete_sucess_message' => ' los registros han sido eliminados',
    'bulk_delete_error_title'    => 'Registros no eliminados',
    'bulk_delete_error_message'  => 'No se pudieron eliminar uno o más registros',

    // Bulk clone
    'bulk_clone_are_you_sure'   => '¿Estás seguro de que deseas clonar :number registros?',
    'bulk_clone_sucess_title'   => 'Registros clonados',
    'bulk_clone_sucess_message' => ' los registros han sido clonados.',
    'bulk_clone_error_title'    => 'Registros no clonados',
    'bulk_clone_error_message'  => 'No se pudieron clonar uno o más registros',

    // Ajax errors
    'ajax_error_title' => 'Error',
    'ajax_error_text'  => 'Error al cargar la página. Por favor, vuelva a cargar la página.',

    // DataTables translation
    'emptyTable'     => 'No hay datos disponibles en la tabla',
    'info'           => 'Mostrando registros _START_ a _END_ de un total de _TOTAL_ registros',
    'infoEmpty'      => 'Mostrando 0 registros',
    'infoFiltered'   => '(filtrando de _MAX_ registros totales)',
    'infoPostFix'    => '.',
    'thousands'      => ',',
    'lengthMenu'     => '_MENU_ elementos por página',
    'loadingRecords' => 'Cargando...',
    'processing'     => 'Procesando...',
    'search'         => 'Buscar: ',
    'zeroRecords'    => 'No se encontraron elementos',
    'paginate'       => [
        'first'    => 'Primero',
        'last'     => 'Último',
        'next'     => 'Siguiente',
        'previous' => 'Anterior',
    ],
    'aria' => [
        'sortAscending'  => ': activar para ordenar ascendentemente',
        'sortDescending' => ': activar para ordenar descendentemente',
    ],

    'export' => [
        'export'            => 'Exportar',
        'copy'              => 'Copiar',
        'excel'             => 'Excel',
        'csv'               => 'CSV',
        'pdf'               => 'PDF',
        'print'             => 'Imprimir',
        'column_visibility' => 'Ver columnas',
    ],

    // global crud - errors
    'unauthorized_access' => 'Acceso denegado - usted no tiene los permisos necesarios para ver esta página.',
    'please_fix'          => 'Por favor corrija los siguientes errores:',

    // global crud - success / error notification bubbles
    'insert_success' => 'El elemento ha sido añadido de manera correcta.',
    'update_success' => 'El elemento ha sido modificado de manera correcta.',

    // CRUD reorder view
    'reorder'                      => 'Reordenar',
    'reorder_text'                 => 'Arrastrar y soltar para reordenar.',
    'reorder_success_title'        => 'Hecho',
    'reorder_success_message'      => 'El orden ha sido guardado.',
    'reorder_error_title'          => 'Error',
    'reorder_error_message'        => 'El orden no se ha guardado.',

    // CRUD yes/no
    'yes' => 'Sí',
    'no'  => 'No',

    // CRUD filters navbar view
    'filters'        => 'Filtros',
    'toggle_filters' => 'Alternar filtros',
    'remove_filters' => 'Remover filtros',
    'apply'          => 'Aplicar',

    //filters language strings
    'today' => 'Hoy',
    'yesterday' => 'Ayer',
    'last_7_days' => 'Últimos 7 días',
    'last_30_days' => 'Últimos 30 días',
    'this_month' => 'Este mes',
    'last_month' => 'Último mes',
    'custom_range' => 'Intervalo personalizado',
    'weekLabel' => 'S',

    // Fields
    'browse_uploads'            => 'Subir archivos',
    'select_all'                => 'Seleccionar todo',
    'select_files'              => 'Selecciona archivos',
    'select_file'               => 'Selecciona un archivo',
    'clear'                     => 'Limpiar',
    'page_link'                 => 'Enlace',
    'page_link_placeholder'     => 'http://example.com/su-pagina',
    'internal_link'             => 'Enlace interno',
    'internal_link_placeholder' => 'Slug interno. Ejemplo: \'admin/page\' (sin comillas) para \':url\'',
    'external_link'             => 'Enlace externo',
    'choose_file'               => 'Elegir archivo',
    'new_item'                  => 'Nuevo elemento',
    'select_entry'              => 'Selecciona un registro',
    'select_entries'            => 'Selecciona registros',

    // Table field
    'table_cant_add'    => 'No se puede agregar una nueva :entity',
    'table_max_reached' => 'El número máximo de :max alcanzado',

    // File manager
    'file_manager' => 'Administrar Archivos',

    // InlineCreateOperation
    'related_entry_created_success' => 'Los registros relacionados se han creado correctamente.',
    'related_entry_created_error' => 'No puedes crear registros relacionados.',
];
