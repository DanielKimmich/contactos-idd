<?php
//para insertar estos datos a la db :php artisan db:seed --class=ContactContentTypes
use Illuminate\Database\Seeder;
use App\Models\ContentType;

class ContactContentTypesChurch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    //Eliminar si existen
        \DB::table('world_cities')->where('mimetype', 'Gift')->delete();
        \DB::table('world_cities')->where('mimetype', 'Talent')->delete();       
        \DB::table('world_cities')->where('mimetype', 'Ministry')->delete();
        
    //Insertar nuevos
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'Gift',
                'label'     => 'Don',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'Talent',
                'label'     => 'Talento',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'Ministry',
                'label'     => 'Ministerio',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
        ));

        $type_G = ContentType::where('type', 'Gift')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'PROPHESYING',
                'label'     => 'Profecía',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'SERVING',
                'label'     => 'Servicio',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'TEACHING',
                'label'     => 'Enseñanza',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'ENCOURAGING',
                'label'     => 'Exhortación',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'GIVING',
                'label'     => 'Dar',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'LEADING',
                'label'     => 'Administración',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'MERCY',
                'label'     => 'Misericordia',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
        ));

        $type_T = ContentType::where('type', 'Talent')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'LINGUISTIC',
                'label'     => 'Lingüístico - Verbal',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'MATHEMATICAL',
                'label'     => 'Lógico - Matemático',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'MUSICAL',
                'label'     => 'Musical',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'SPATIAL',
                'label'     => 'Visual - Espacial',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'BODILY',
                'label'     => 'Corporal - Kinestésica',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'INTRAPERSONAL',
                'label'     => 'Intrapersonal',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'INTERPERSONAL',
                'label'     => 'Interpersonal',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            7 => 
            array (
                'type'      => 'NATURALIST',
                'label'     => 'Naturalista',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            8 => 
            array (
                'type'      => 'EMOTIONAL',
                'label'     => 'Emocional',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            9 => 
            array (
                'type'      => 'EXISTENTIAL',
                'label'     => 'Existencial - Espiritual',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'CREATIVE',
                'label'     => 'Creativo',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'Colaborative',
                'label'     => 'Colaborativa',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
        ));

        $type_M = ContentType::where('type', 'Ministry')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'WORSHIP',
                'label'     => 'Alabanza y Adoración',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'MULTIMEDIA',
                'label'     => 'Multimedia y Comunicación',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'INTERCESSION',
                'label'     => 'Intercesión',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'COMMITTEE',
                'label'     => 'CONSEJO LOCAL',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'ADMINISTRATION',
                'label'     => 'Administración',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'PASTOR',
                'label'     => 'Consejería y Pastorado',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'EVANGELISM',
                'label'     => 'Evangelismo y Misiones',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            7 => 
            array (
                'type'      => 'TRAINING',
                'label'     => 'Capacitación y Discipulado',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            8 => 
            array (
                'type'      => 'SOCIAL',
                'label'     => 'Acción Social',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            9 => 
            array (
                'type'      => 'VISITATION',
                'label'     => 'Visitación',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'ART',
                'label'     => 'Arte',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'JUNIOR',
                'label'     => 'Niñez',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            12 => 
            array (
                'type'      => 'TEENS',
                'label'     => 'Preadolescentes y Adolescentes',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            13 => 
            array (
                'type'      => 'YOUNG',
                'label'     => 'Jóvenes',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            14 => 
            array (
                'type'      => 'FAMILIES',
                'label'     => 'Familias y Matrimonios',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            15 => 
            array (
                'type'      => 'WOMEN',
                'label'     => 'Mujeres',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            16 => 
            array (
                'type'      => 'MENS',
                'label'     => 'Hombres',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),
            17 => 
            array (
                'type'      => 'ADULTS',
                'label'     => 'Adultos',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => '',
                'rgt'       => '',
                'extras'    => '',
            ),

        ));


    }
}

/* Talentos
Lingüístico - Verbal
Lógico - Matemático
Musical
Visual - Espacial
Corporal - Kinestésica
Intrapersonal
Interpersonal
Naturalista
Emocional
Existencial - Espiritual
Creativo
Colaborativa
*/

/* Ministerios
Alabanza y Adoracion
Multimedia y Comunicacion
Intercesion
Consejo Local
Administracion
Consejeria y Pastorado
Evangelismo y Misiones
Discipulado y Capacitacion
Accion Social
Visitacion
Arte
Niñez
Pre-Adolescentes y Adolescentes
Jovenes
Matrimonios y Familias
Mujeres
Hombres
Adultos
*/