<?php

return array (
    'data'       => 'Datos',
    'info'       => 'Informacion',
    'updated_at'    => 'Actualizado el',
    'created_at'    => 'Creado el',
    'updated_by'    => 'Actualizado por',
    'created_by'    => 'Creado por',
    'updated_range' => 'Actualizado entre',

//POST
    'post'      => [
        'title'         => 'Publicación',
        'titles'        => 'Publicaciones',
    //Fields                
        'title_header'  => 'Título',
        'description'   => 'Resumen',
        'body'          => 'Contenido',
        'tags'          => 'Etiquetas',
        'author'        => 'Nombre de Contacto',
        'category'      => 'Categoría',
        'posted_at'     => 'Fecha Publicación',
        'status'        => 'Ver Publicación',
        'slug'          => 'Slug (URL)',     
        'slug_hint'     => 'Se genera automáticamente al crear a partir del título',
        'comments'      => 'Comentarios',
    ],    

//COMMENT
    'comment'    => [
        'title'         => 'Comentario',
        'titles'        => 'Comentarios',
    //Fields                
        'title_header'  => 'Título',
        'body'          => 'Contenido',
        'status'        => 'Ver Comentario',
        'slug'          => 'Slug (URL)',     
        'slug_hint'     => 'Se genera automáticamente al crear a partir del título de la publicación',
    ],    

//CATEGORY
    'category'    => [
        'title'         => 'Categoría',
        'titles'        => 'Categorías',
    //Fields                
        'name'          => 'Nombre',
        'description'   => 'Descripción',
        'slug'          => 'Slug (URL)',
        'slug_hint'     => 'Se genera automáticamente al crear a partir del nombre',
    ],    

//TAG
    'tag'         => [
        'title'         => 'Etiqueta',
        'titles'        => 'Etiquetas',
    //Fields                
        'name'          => 'Nombre',
        'description'   => 'Descripción',
        'slug'          => 'Slug (URL)',     
        'slug_hint'     => 'Se genera automáticamente al crear a partir del nombre',
    ],    

//NOTIFICATION
    'notification'    => [
        'entity_name'   => 'Notificación',
        'entity_names'  => 'Notificaciones',
    //Fields                
        'title'         => 'Título',
        'body'          => 'Contenido',
        'color'         => 'Estilo',
        'priority'      => 'Prioridad',     
        'expires_at'    => 'Expira el',
    ],    

);
