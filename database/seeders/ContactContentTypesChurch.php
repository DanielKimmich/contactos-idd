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
        \DB::table('content_types')->where('mimetype', 'Church')->delete();
        \DB::table('content_types')->where('mimetype', 'Gift')->delete();
        \DB::table('content_types')->where('mimetype', 'Talent')->delete();       
        \DB::table('content_types')->where('mimetype', 'Ministry')->delete();

    //Insertar nuevos Tipos
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'Gift',
                'label'     => '{"es": "Don"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'Talent',
                'label'     => '{"es": "Talento"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'Ministry',
                'label'     => '{"es": "Ministerio"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'Church',
                'label'     => '{"es": "Datos"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

        ));

/*Church Event
    Fecha Conversion      / calcular edad        / lugar / pastor
    Fecha Bautismo        / calcular edad        / lugar / pastor
    Fecha Congregarse     / calcular antiguedad  / medio / pastor
    Fecha Miembro         / calcular antiguedad  / motivo / pastor
    Fecha Baja
*/       
    //Insertar parent church
        $type_C = ContentType::where('type', 'Church')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'CONVERSION',
                'label'     => '{"es": "Conversión"}',
                'parent_id' => $type_C,
                'depth'     => '2',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'BAPTISM',
                'label'     => '{"es": "Bautismo"}',
                'parent_id' => $type_C,
                'depth'     => '2',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'CONGREGATE',
                'label'     => '{"es": "Congregarse"}',
                'parent_id' => $type_C,
                'depth'     => '2',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'MEMBER',
                'label'     => '{"es": "Miembro"}',
                'parent_id' => $type_C,
                'depth'     => '2',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'CLOSURE',
                'label'     => '{"es": "Cierre"}',
                'parent_id' => $type_C,
                'depth'     => '2',
                'mimetype'  => 'Church',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),            
        ));

    //Insertar parent gift
        $type_G = ContentType::where('type', 'Gift')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'PROPHESYING',
                'label'     => '{"es": "Profecía"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'SERVING',
                'label'     => '{"es": "Servicio"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'TEACHING',
                'label'     => '{"es": "Enseñanza"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'ENCOURAGING',
                'label'     => '{"es": "Exhortación"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'GIVING',
                'label'     => '{"es": "Dar"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'LEADING',
                'label'     => '{"es": "Administración"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'MERCY',
                'label'     => '{"es": "Misericordia"}',
                'parent_id' => $type_G,
                'depth'     => '2',
                'mimetype'  => 'Gift',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
        ));

    //Insertar parent talent
        $type_T = ContentType::where('type', 'Talent')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'LINGUISTIC',
                'label'     => '{"es": "Lingüístico - Verbal"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'MATHEMATICAL',
                'label'     => '{"es": "Lógico - Matemático"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'MUSICAL',
                'label'     => '{"es": "Musical"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'SPATIAL',
                'label'     => '{"es": "Visual - Espacial"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'BODILY',
                'label'     => '{"es": "Corporal - Kinestésica"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'INTRAPERSONAL',
                'label'     => '{"es": "Intrapersonal"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'INTERPERSONAL',
                'label'     => '{"es": "Interpersonal"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            7 => 
            array (
                'type'      => 'NATURALIST',
                'label'     => '{"es": "Naturalista"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            8 => 
            array (
                'type'      => 'EMOTIONAL',
                'label'     => '{"es": "Emocional"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            9 => 
            array (
                'type'      => 'EXISTENTIAL',
                'label'     => '{"es": "Existencial - Espiritual"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'CREATIVE',
                'label'     => '{"es": "Creativo"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'Colaborative',
                'label'     => '{"es": "Colaborativa"}',
                'parent_id' => $type_T,
                'depth'     => '2',
                'mimetype'  => 'Talent',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
        ));

    //Insertar parent ministry
        $type_M = ContentType::where('type', 'Ministry')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'WORSHIP',
                'label'     => '{"es": "Alabanza y Adoración"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'MULTIMEDIA',
                'label'     => '{"es": "Multimedia y Comunicación"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'INTERCESSION',
                'label'     => '{"es": "Intercesión"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'COMMITTEE',
                'label'     => '{"es": "Consejo Local"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'ADMINISTRATION',
                'label'     => '{"es": "Administración"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            5 => 
            array (
                'type'      => 'PASTOR',
                'label'     => '{"es": "Consejería y Pastorado"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            6 => 
            array (
                'type'      => 'EVANGELISM',
                'label'     => '{"es": "Evangelismo y Misiones"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            7 => 
            array (
                'type'      => 'TRAINING',
                'label'     => '{"es": "Capacitación y Discipulado"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            8 => 
            array (
                'type'      => 'SOCIAL',
                'label'     => '{"es": "Acción Social"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            9 => 
            array (
                'type'      => 'VISITATION',
                'label'     => '{"es": "Visitación"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'ART',
                'label'     => '{"es": "Arte"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'JUNIOR',
                'label'     => '{"es": "Niñez"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            12 => 
            array (
                'type'      => 'TEENS',
                'label'     => '{"es": "Preadolescentes y Adolescentes"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            13 => 
            array (
                'type'      => 'YOUNG',
                'label'     => '{"es": "Jóvenes"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            14 => 
            array (
                'type'      => 'FAMILIES',
                'label'     => '{"es": "Familias y Matrimonios"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            15 => 
            array (
                'type'      => 'WOMEN',
                'label'     => '{"es": "Mujeres"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            16 => 
            array (
                'type'      => 'MENS',
                'label'     => '{"es": "Hombres"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            17 => 
            array (
                'type'      => 'ADULTS',
                'label'     => '{"es": "Adultos"}',
                'parent_id' => $type_M,
                'depth'     => '2',
                'mimetype'  => 'Ministry',
                'lft'       => null,
                'rgt'       => null,
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