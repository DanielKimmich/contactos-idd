<?php

return [
	'contact_name'    => 'Nombre de Contacto',
	'contact_person'    => 'Contact Person',
	'updated_at' 		=> 'Actualizado el',
    'created_at' 		=> 'Creado el',


	'is_required'     => 'Contact is required',

//PHONE
  'phone'    => [
		'title'             => 'Phone',
		'titles'             => 'Phones',
		'add_new'           => 'Añadir nuevo telefono',
		'delete_confirm' 	=> 'Are you sure you want to delete this telefono?',		
	// Messages
		'no_rows'           => 'There are no telefonos',
        'is_required'       => 'Telefono is required',
		'is_deleted'        => 'Telefono was deleted',
		'is_created'        => 'Telefono was created',
	//Fields				
		'number'          => 'Number',
		'type'            => 'Type',
		'label'           => 'Label',
		'normalized'      => 'Normalized',
    ],

//ADDRESS
   'address'    => [
		'title'             => 'Dirección',
		'titles'            => 'Direcciones',		
		'add_new'           => 'Añadir nueva dirección',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar esta dirección?',		
	// Messages
		'no_rows'           => 'No hay direcciones',
        'is_required'       => 'Se requiere la dirección',
		'is_deleted'        => 'La dirección fue eliminado',
		'is_created'        => 'la dirección fue creado',
	//Fields					
        'address' => 'Dirección',
        'type'    => 'Tipo',
        'label'  => 'Etiqueta',
        'street'   => 'Calle',
        'pobox'    => 'Codigo Postal',
        'neigh'  => 'Barrio',
        'city'   => 'Ciudad',        
        'region'    => 'Provincia',
        'postcode'  => 'Postcode',
        'country'   => 'Pais',   
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