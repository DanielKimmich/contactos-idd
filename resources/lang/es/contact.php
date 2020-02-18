<?php

return [
	'title'         => 'Contacto',
	'titles'        => 'Contactos',
	'display_name'  => 'Nombre de Contacto',
	'sex'			=> 'Sexo',
	'nationality'	=> 'Nacionalidad',
	'status'		=> 'Estado',
	'updated_at' 	=> 'Actualizado el',
    'created_at' 	=> 'Creado el',


	'is_required'     => 'Contact is required',

//NAME
  	'name'    => [
		'first'     => 'Nombre',
		'middle'    => 'Segundo Nombre',
		'family'    => 'Apellidos',

    ],

//EVENT
  	'event'    => [
		'birthday'      => 'Fecha de Nacimiento',
	],

//DOCUMENT
  	'document'    => [
		'number'      => 'Numero de Documento',
	],


//PHONE
  'phone'    => [
		'title'             => 'Telefono',
		'titles'            => 'Telefonos',
	//Fields				
		'number'          => 'Numero',
		'type'            => 'Tipo',
		'label'           => 'Etiqueta',
		'normalized'      => 'Normalizado',
	// Messages
		'no_rows'           => 'There are no telefonos',
        'is_required'       => 'Telefono is required',
		'is_deleted'        => 'Telefono was deleted',
		'is_created'        => 'Telefono was created',
		'delete_confirm' 	=> 'Are you sure you want to delete this telefono?',
    ],

//EMAIL
  'email'    => [
		'title'             => 'Correo Electronico',
		'titles'            => 'Correos Electronicos',
	//Fields				
		'address'          	=> 'Direccion de Correo',
		'type'            	=> 'Tipo',
		'label'           	=> 'Etiqueta',
		'display_name'  	=> 'Nombre a Mostrar',
	// Messages
		'no_rows'           => 'There are no telefonos',
        'is_required'       => 'Telefono is required',
		'is_deleted'        => 'Telefono was deleted',
		'is_created'        => 'Telefono was created',
		'delete_confirm' 	=> 'Are you sure you want to delete this telefono?',
    ],

//ADDRESS
   'address'    => [
		'title'             => 'Dirección',
		'titles'            => 'Direcciones',		
	//Fields					
        'address' 	=> 'Dirección Completa',
        'type'    	=> 'Tipo',
        'label'  	=> 'Etiqueta',
        'street'   	=> 'Calle',
        'pobox'    	=> 'Codigo Postal',
        'neigh'  	=> 'Barrio',
        'city'   	=> 'Ciudad',        
        'region'    => 'Provincia',
        'postcode'  => 'Postcode',
        'country'   => 'Pais',   
		'add_new'           => 'Añadir nueva dirección',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar esta dirección?',		
	// Messages
		'no_rows'           => 'No hay direcciones',
        'is_required'       => 'Se requiere la dirección',
		'is_deleted'        => 'La dirección fue eliminado',
		'is_created'        => 'la dirección fue creado',
    ],

//RELATION
   'relation'    => [
		'title'             => 'Relación',
		'titles'            => 'Relaciones',		
		'add_new'           => 'Añadir nueva relación',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar esta relación?',		
	// Messages
		'no_rows'           => 'No hay relaciones',
        'is_required'       => 'Se requiere la relación',
		'is_deleted'        => 'La relación fue eliminado',
		'is_created'        => 'la relación fue creado',
	//Fields					
        'name' => 'Nombre',
        'type'    => 'Tipo',
        'label'  => 'Etiqueta',
   
    ],

//TYPE
  'type'    => [
		'title'             => 'Tipo de Contenido',
		'titles'             => 'Tipos de Contenido',
		'add_new'           => 'Añadir nuevo tipo',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar este tipo?',		
	// Messages
		'no_rows'           => 'No hay tipos',
        'is_required'       => 'Se requiere el tipo',
		'is_deleted'        => 'El tipo fue eliminado',
		'is_created'        => 'El tipo fue creado',
	//Fields				
		'mimetype'          => 'Tipo mime',
		'type'            	=> 'Tipo',
		'label'           	=> 'Etiqueta',
		'value'      		=> 'Orden',
    ],    
];