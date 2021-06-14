<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentType;

class ContactContentTypesPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    //Eliminar si existen
        \DB::table('content_types')->where('mimetype', 'Module')->delete();
        \DB::table('content_types')->where('mimetype', 'Operation')->delete();

    //Insertar nuevos Tipos
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'Module',
                'label'     => '{"es": "Módulo"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'Operation',
                'label'     => '{"es": "Operación"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

        ));
     
    //Insertar parent Module
        $type_M = ContentType::where('type', 'Module')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'contactperson',
                'label'     => '{"es": "Personas"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'contactfamily',
                'label'     => '{"es": "Familias"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'contactchurch',
                'label'     => '{"es": "Eclesiásticos"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'contactdata',
                'label'     => '{"es": "Datos"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'contactsetting',
                'label'     => '{"es": "Preferencias"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),            
            5 => 
            array (
                'type'      => 'blogpost',
                'label'     => '{"es": "Publicaciones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'blogcategory',
                'label'     => '{"es": "Categorías"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            7 => 
            array (
                'type'      => 'blogtag',
                'label'     => '{"es": "Etiquetas"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            8 => 
            array (
                'type'      => 'blogcomment',
                'label'     => '{"es": "Comentarios"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            9 => 
            array (
                'type'      => 'worldcontinent',
                'label'     => '{"es": "Continentes"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),        
            10 => 
            array (
                'type'      => 'worldcountry',
                'label'     => '{"es": "Paises"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'worlddivision',
                'label'     => '{"es": "Provincias"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            12 => 
            array (
                'type'      => 'worldcity',
                'label'     => '{"es": "Ciudades"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            13 => 
            array (
                'type'      => 'authpermission',
                'label'     => '{"es": "Permisos"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            14 => 
            array (
                'type'      => 'authrole',
                'label'     => '{"es": "Roles"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),            
            15 => 
            array (
                'type'      => 'authuser',
                'label'     => '{"es": "Usuarios"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            16 => 
            array (
                'type'      => 'authchecker',
                'label'     => '{"es": "Sesiones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            17 => 
            array (
                'type'      => 'managermigrate',
                'label'     => '{"es": "actualizaciones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            18 => 
            array (
                'type'      => 'blognotification',
                'label'     => '{"es": "Notificaciones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            19 => 
            array (
                'type'      => 'managerbackup',
                'label'     => '{"es": "Copias"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),        
            20 => 
            array (
                'type'      => 'managersetting',
                'label'     => '{"es": "Configuraciones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            21 => 
            array (
                'type'      => 'managerlog',
                'label'     => '{"es": "Logs"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            22 => 
            array (
                'type'      => 'managerfile',
                'label'     => '{"es": "Archivos"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Module',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

        ));

    //Insertar parent Operation
        $type_O = ContentType::where('type', 'Operation')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'list',
                'label'     => '{"es": "Listado"}',
                'parent_id' => $type_O,
                'depth'     => '2',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'show',
                'label'     => '{"es": "Ver"}',
                'parent_id' => $type_O,
                'depth'     => '2',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'create',
                'label'     => '{"es": "Añadir"}',
                'parent_id' => $type_O,
                'depth'     => '2',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'update',
                'label'     => '{"es": "Editar"}',
                'parent_id' => $type_O,
                'depth'     => '2',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'delete',
                'label'     => '{"es": "Eliminar"}',
                'parent_id' => $type_O,
                'depth'     => '2',
                'mimetype'  => 'Operation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

        ));

    }
}

