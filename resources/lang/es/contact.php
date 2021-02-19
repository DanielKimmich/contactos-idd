<?php

return [
	'data'  		=> 'Datos',
    'info'  		=> 'Información',
    'updated_at'    => 'Actualizado el',
    'created_at'    => 'Creado el',
    'updated_by'    => 'Actualizado por',
    'created_by'    => 'Creado por',
    'updated_range' => 'Actualizado entre',
    'birthday'      => 'Cumpleaños',
    'age_range' 	=> 'Edades entre',    


//POST
    'person'      => [
        'entity_name'   => 'Persona',
        'entity_names'  => 'Personas',
    //Fields
		'display_name'  => 'Nombre Completo',
		'sex'			=> 'Género',
		'nationality'	=> 'Nacionalidad',
		'civil_status'	=> 'Estado Civil',
		'status'		=> 'Estado',
	// Messages
		'nocivilstatus'	=> 'Sin Estado Civil',
    ],

//NAME
  	'name'    => [
		'tab'  		=> 'Nombres',
	//Fields
		'first'     => 'Primer Nombre',
		'middle'    => 'Segundo Nombre',
		'family'    => 'Apellidos',
		'prefix'    => 'Prefijo',
		'suffix'    => 'Apodo / Sobrenombre',
		'nickname'  => 'apodo, sobrenombre',
    ],

//EVENT
  	'event'    => [
	//Fields
		'birthday'      => 'Nacido el',
		'deadday'       => 'Fallecido el',
		'age'      		=> 'Edad',
	// Messages
		'delete_confirm' => 'Si cambia el estado de Fallecido, entonces se eliminará la fecha. ¿Está seguro que desea eliminar la fecha de fallecido?',
		'nodatebirth'	=> 'Sin Fecha de Nac.',
	],

//DOCUMENT
  	'document'    => [
	//Fields
		'number'      => 'Documento',
	],

//PHONE
    'phone'    => [
		'tab'			=> 'Teléfonos',
		'title'             => 'Teléfono',
		'titles'            => 'Teléfonos',
	//Fields				
		'mobile1'			=> 'Movil_1',
		'home1'				=> 'Teléfono_1',
		'number'          	=> 'Número',
		'type'            	=> 'Tipo',
		'label'           	=> 'Información Adicional',
		'normalized'      	=> 'Normalizado',
	// Messages
		'add_new_item'      => 'Añadir teléfono',
		'no_rows'           => 'There are no telefonos',
        'is_required'       => 'Telefono is required',
		'is_deleted'        => 'Telefono was deleted',
		'is_created'        => 'Telefono was created',
		'delete_confirm' 	=> 'Are you sure you want to delete this telefono?',
    ],

//EMAIL
  'email'    => [
		'tab'		=> 'Correos',
		'title'             => 'Correo Electrónico',
		'titles'            => 'Correos Electrónicos',
	//Fields				
		'email1'			=> 'Correo_1',
		'address'          	=> 'Dirección de Correo',
		'type'            	=> 'Tipo',
		'label'           	=> 'Información Adicional',
		'display_name'  	=> 'Nombre a Mostrar',
	// Messages
		'add_new_item'      => 'Añadir correo',
		'no_rows'           => 'There are no telefonos',
        'is_required'       => 'Telefono is required',
		'is_deleted'        => 'Telefono was deleted',
		'is_created'        => 'Telefono was created',
		'delete_confirm' 	=> 'Are you sure you want to delete this telefono?',
    ],

//ADDRESS
   'address'    => [
		'tab'		=> 'Direcciones',
		'title'             => 'Dirección',
		'titles'            => 'Direcciones',		
	//Fields					
        'address1' 	=> 'Dirección_1',
        'address' 	=> 'Dirección Completa',
        'type'    	=> 'Tipo',
        'label'  	=> 'Información Adicional',
        'street'   	=> 'Calle',
        'pobox'    	=> 'Codigo Postal',
        'neigh'  	=> 'Barrio',
        'city'   	=> 'Ciudad',        
        'division'  => 'Provincia',
        'postcode'  => 'Codigo Postal',
        'country'   => 'Pais',   
	// Messages
		'add_new_item'      => 'Añadir dirección',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar esta dirección?',
		'no_rows'           => 'No hay direcciones',
        'is_required'       => 'Se requiere la dirección',
		'is_deleted'        => 'La dirección fue eliminado',
		'is_created'        => 'la dirección fue creado',
    ],

//PHOTO
	'photo'    => [
		'tab'  		=> 'Foto',
		'profile_image'     => 'Imagen de perfil',    
	// Messages
		'nophoto'	=> 'Sin Foto',
    ],

//BLOOD
  	'blood'    => [
		'tab'  		=> 'Grupo Sanguineo',
	//Fields
		'name'     	=> 'Es donante de Sangre ?',
		'type'  	=> 'Grupo Sanguineo',
		'label'    	=> 'Información Adicional',
	// Messages
		'noblood'	=> 'Sin Grupo Sang.',
    ],

//POST
    'family'      => [
        'entity_name'   => 'Familia',
        'entity_names'  => 'Familias',
    //Fields                
		'display_name'  => 'Nombre Completo',
		'sex'			=> 'Género',
		'civil_status'	=> 'Estado Civil',
		'status'		=> 'Estado',
	// Messages
		'norelation'	=> 'Sin Familia', 
    ],

//PARENT
  	'parent'    => [
		'tab'  		=> 'Padres',
		'data'      => 'Datos',
	//Fields
		'name'     	=> 'Nombre Completo',
		'type'  	=> 'Relación',
		'label'    	=> 'Información Adicional',
    ],
//SPOUSE
  	'spouse'    => [
		'tab'  		=> 'Conyugue',
		'data'      => 'Datos',
	//Fields
		'name'     	=> 'Nombre Completo',
		'type'  	=> 'Relación',
		'label'    	=> 'Información Adicional',
    ],
//CHILDREN
  	'children'    => [
		'tab'  		=> 'Hijos',
		'data'      => 'Datos',
	//Fields
		'name'     	=> 'Nombre Completo',
		'type'  	=> 'Relación',
		'label'    	=> 'Información Adicional',
    ],
//RELATIVE
  	'relative'    => [
		'tab'  		=> 'Familiares',
		'data'      => 'Datos',
	//Fields
		'name'     	=> 'Nombre Completo',
		'type'  	=> 'Relación',
		'label'    	=> 'Información Adicional',
    ],
//OTHER
  	'other'    => [
		'tab'  		=> 'Otros',
		'data'      => 'Datos',
	//Fields
		'name'     	=> 'Nombre Completo',
		'type'  	=> 'Relación',
		'label'    	=> 'Información Adicional',
    ],


//CHURCH
    'church'      => [
        'entity_name'   => 'Eclesiástico',
        'entity_names'  => 'Eclesiásticos',
    //Fields                
		'display_name'  => 'Nombre Completo',
		'sex'			=> 'Género',
		'civil_status'	=> 'Estado Civil',
		'status'		=> 'Estado',
    ],

//DATOS
   'step'    => [
		'tab'		=> 'Datos',
		'title'             => 'Datos',
		'titles'            => 'Fechas Importantes',
	//Fields				
		'name'     	=> 'Fecha',
		'type'  	=> 'Tipo',
		'label'    	=> 'Información Adicional',
		'pastor'  	=> 'Pastor',
		'site'    	=> 'Lugar',		
	// Messages
	],

//GRAFT
   'gift'    => [
		'tab'		=> 'Dones',
		'title'             => 'Don Espiritual',
		'titles'            => 'Dones Espirituales',
	//Fields				
		'name'     	=> 'Nombre del don',
		'type'  	=> 'Tipo',
		'label'    	=> 'Información Adicional',
	// Messages
	],

//TALENT
   'talent'    => [
		'tab'		=> 'Talentos',
		'title'             => 'Talento',
		'titles'            => 'Talentos y Habilidades',
	//Fields				
		'name'     	=> 'Nombre del talento',
		'type'  	=> 'Tipo de Inteligencia',
		'label'    	=> 'Información Adicional',
	// Messages
	],

//MINISTRY
   'ministry'    => [
		'tab'		=> 'Ministerios',
		'title'             => 'Ministerio',
		'titles'            => 'Ministerios en la Iglesia',
	//Fields				
		'name'     	=> 'Nombre del ministerio',
		'type'  	=> 'Tipo',
		'label'    	=> 'Información Adicional',
	// Messages
	],

//TYPE
  'type'    => [
		'entity_name'       => 'Preferencia',
		'entity_names'      => 'Preferencias',
	//Fields				
		'type'            	=> 'Código',
		'label'           	=> 'Nombre',
		'mimetype'          => 'Tipo',
   		'parent'			=> 'Categoria',
		'level'      		=> 'Nivel',
		'order'      		=> 'Orden', 
   		'extras'			=> 'Información Adicional',
   		'firstlevel'		=> 'Nivel_1',
	// Messages
		'no_rows'           => 'No hay tipos',
        'is_required'       => 'Se requiere el tipo',
		'is_deleted'        => 'El tipo fue eliminado',
		'is_created'        => 'El tipo fue creado',
		'add_new'           => 'Añadir nuevo tipo',
		'delete_confirm' 	=> '¿Estás seguro de que quieres borrar este tipo?',
    ],  

];