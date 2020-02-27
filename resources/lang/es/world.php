<?php

return array (
    'data'  => 'Datos',
    'info'  => 'Informacion',
    'updated_at' => 'Actualizado el',
    'created_at' => 'Creado el',
//CONTINENT
    'continent'    => [
        'title'             => 'Continente',
        'titles'            => 'Continentes',
    //Fields                
        'name' => 'Nombre',
        'code' => 'Codigo',
    ],    
//COUNTRY
    'country'    => [
        'title'             => 'Pais',
        'titles'            => 'Paises',
    //Fields                
        'name' => 'Nombre',
        'code' => 'Codigo',
        'code_alpha3' => 'Código alpha3',
        'continent' => 'Continente',
        'full_name' => 'Nombre completo',
        'capital' => 'Capital',
        'has_division' => 'con Provincias',
        'emoji' => 'Emoji',
        'currency_code' => 'Código de moneda',
        'currency_name' => 'Nombre de moneda',
        'calling_code' => 'Prefijo llamada',
        'tld' => 'Código de dominio',
    ],    
//DIVISION
    'division'    => [
        'title'             => 'Provincia',
        'titles'            => 'Provincias',
    //Fields                
        'name' => 'Nombre',
        'code' => 'Codigo',
        'country' => 'Pais',
        'full_name' => 'Nombre completo',
        'has_city' => 'con Ciudades',
    ],    

//CITY
    'city'    => [
        'title'             => 'Ciudad',
        'titles'            => 'Ciudades',
    //Fields                
        'name' => 'Nombre',
        'code' => 'Codigo',
        'country' => 'Pais',
        'division' => 'Provincia',
        'full_name' => 'Nombre completo',
    ],    

        'Xhas_city' => 'con Ciudades',
  'Xname' => 'Nombre',
  'Xfull_name' => 'Nombre completo',
  'Xcode' => 'Codigo',
  
  'Xcontinent' => 'Continente',
  'Xcontinents' => 'Continentes',
  'Xcountry' => 'Pais',
  'Xcountries' => 'Paises',  
  'Xdivision' => 'Provincia',
  'Xdivisions' => 'Provincias',  
  'Xcity' => 'Ciudad',
  'Xcities' => 'Ciudades',  
  'Xcapital' => 'Capital',
  

  'date_range' => 'Actualizado entre',

);
