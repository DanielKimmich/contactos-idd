<?php

return [
    'updated_at'    => 'Actualizado el',
    'created_at'    => 'Creado el',
    'updated_by'    => 'Actualizado por',
    'created_by'    => 'Creado por',
    'updated_range' => 'Actualizado entre',
    'birthday'      => 'Cumpleaños',
    'age_range' 	=> 'Edades entre',    

	'title'         => 'Contacto',
	'titles'        => 'Contactos',
//Tabs
	'names'			=> 'Nombres',
	'data'  		=> 'Datos',
	'phones'		=> 'Teléfonos',
	'emails'		=> 'Correos',
	'addresses'		=> 'Direcciones',
	'photos'  		=> 'Foto',
    'info'  		=> 'Información',
//Fields
	'display_name'  => 'Nombre de Contacto',
	'sex'			=> 'Genero',
	'nationality'	=> 'Nacionalidad',
	'status'		=> 'Estado',
	'is_required'   => 'Contact is required',

//NAME
  	'name'    => [
		'first'     => 'Primer Nombre',
		'middle'    => 'Segundo Nombre',
		'family'    => 'Apellidos',

    ],

//EVENT
  	'event'    => [
		'birthday'      => 'Nacido el',
		'age'      		=> 'Edad',
	],

//DOCUMENT
  	'document'    => [
		'number'      => 'Documento',
	],

//PHONE
  'phone'    => [
		'title'             => 'Telefono',
		'titles'            => 'Telefonos',
	//Fields				
		'mobile1'			=> 'Movil_1',
		'home1'				=> 'Telefono_1',
		'number'          	=> 'Numero',
		'type'            	=> 'Tipo',
		'label'           	=> 'Info Adicional',
		'normalized'      	=> 'Normalizado',
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
		'email1'			=> 'Correo_1',
		'address'          	=> 'Direccion de Correo',
		'type'            	=> 'Tipo',
		'label'           	=> 'Info Adicional',
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
        'address1' 	=> 'Dirección_1',
        'address' 	=> 'Dirección Completa',
        'type'    	=> 'Tipo',
        'label'  	=> 'Info Adicional',
        'street'   	=> 'Calle',
        'pobox'    	=> 'Codigo Postal',
        'neigh'  	=> 'Barrio',
        'city'   	=> 'Ciudad',        
        'division'  => 'Provincia',
        'postcode'  => 'Codigo Postal',
        'country'   => 'Pais',   
		'add_new'           => 'Añadir nueva dirección',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar esta dirección?',		
	// Messages
		'no_rows'           => 'No hay direcciones',
        'is_required'       => 'Se requiere la dirección',
		'is_deleted'        => 'La dirección fue eliminado',
		'is_created'        => 'la dirección fue creado',
    ],

//PHOTO
	'photo'    => [
		'profile_image'     => 'Imagen de perfil',    
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
        'name' 		=> 'Nombre',
        'type'  	=> 'Tipo',
        'label'  	=> 'Etiqueta',
    ],

//TYPE
  'type'    => [
		'title'             => 'Preferencia',
		'titles'            => 'Preferencias',
		'add_new'           => 'Añadir nuevo tipo',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar este tipo?',		
	// Messages
		'no_rows'           => 'No hay tipos',
        'is_required'       => 'Se requiere el tipo',
		'is_deleted'        => 'El tipo fue eliminado',
		'is_created'        => 'El tipo fue creado',
	//Fields				
		'mimetype'          => 'Origen',
		'type'            	=> 'Código',
		'label'           	=> 'Nombre',
		'order'      		=> 'Orden',
   		'parent'			=> 'Categoria',
   		'firstlevel'		=> 'Principal',
    ],    
];