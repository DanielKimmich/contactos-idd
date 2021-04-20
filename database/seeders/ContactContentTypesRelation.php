<?php
//para insertar estos datos a la db :php artisan db:seed --class=ContactContentTypes
use Illuminate\Database\Seeder;
use App\Models\ContentType;

class ContactContentTypesRelation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    //Eliminar si existen
        \DB::table('content_types')->where('mimetype', 'Relation')->delete();

    //Insertar nuevo Tipo
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'Relation',
                'label'     => '{"es": "Relación"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
        ));

    //Insertar parent relation
        $type_R = ContentType::where('type', 'Relation')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_PARENT',
                'label'     => '{"es": "Padres"}',
                'parent_id' => $type_R,
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'TYPE_SPOUSE',
                'label'     => '{"es": "Conyugue"}',
                'parent_id' => $type_R,
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'TYPE_CHILDREN',
                'label'     => '{"es": "Hijos"}',
                'parent_id' => $type_R,
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            3 => 
            array (
                'type'      => 'TYPE_RELATIVE',
                'label'     => '{"es": "Familiares"}',
                'parent_id' => $type_R,
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 => 
            array (
                'type'      => 'TYPE_OTHERS',
                'label'     => '{"es": "Otros"}',
                'parent_id' => $type_R,
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
        ));

    //Insertar parent parent
        $type_P = ContentType::where('type', 'TYPE_PARENT')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_FATHER',
                'label'     => '{"es": "Padre"}',
                'parent_id' => $type_P,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTER"},{"data1":"MALE","data2":"TYPE_SON"}]',
            ),
            1 => 
            array (
                'type'      => 'TYPE_MOTHER',
                'label'     => '{"es": "Madre"}',
                'parent_id' => $type_P,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTER"},{"data1":"MALE","data2":"TYPE_SON"}]',
            ),
            2 => 
            array (
                'type'      => 'TYPE_STEPFATHER',
                'label'     => '{"es": "Padrastro"}',
                'parent_id' => $type_P,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPDAUGHTER"},{"data1":"MALE","data2":"TYPE_STEPSON"}]',
            ),
            3 => 
            array (
                'type'      => 'TYPE_STEPMOTHER',
                'label'     => '{"es": "Madrastra"}',
                'parent_id' => $type_P,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPDAUGHTER"},{"data1":"MALE","data2":"TYPE_STEPSON"}]',
            ),
        ));

    //Insertar parent spouse
        $type_S = ContentType::where('type', 'TYPE_SPOUSE')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_HUSBAND',
                'label'     => '{"es": "Esposo"}',
                'parent_id' => $type_S,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_WIFE"}]',
            ),
            1 => 
            array (
                'type'      => 'TYPE_WIFE',
                'label'     => '{"es": "Esposa"}',
                'parent_id' => $type_S,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"MALE","data2":"TYPE_HUSBAND"}]',
            ),
            2 => 
            array (
                'type'      => 'TYPE_EXHUSBAND',
                'label'     => '{"es": "ExEsposo"}',
                'parent_id' => $type_S,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 => 
            array (
                'type'      => 'TYPE_EXWIFE',
                'label'     => '{"es": "ExEsposa"}',
                'parent_id' => $type_S,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
        ));

    //Insertar parent children
        $type_C = ContentType::where('type', 'TYPE_CHILDREN')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_SON',
                'label'     => '{"es": "Hijo"}',
                'parent_id' => $type_C,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHER"},{"data1":"MALE","data2":"TYPE_FATHER"}]',
            ),                 
            1 => 
            array (
                'type'      => 'TYPE_DAUGHTER',
                'label'     => '{"es": "Hija"}',
                'parent_id' => $type_C,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHER"},{"data1":"MALE","data2":"TYPE_FATHER"}]',
            ),                 
            2 => 
            array (
                'type'      => 'TYPE_STEPSON',
                'label'     => '{"es": "Hijastro"}',
                'parent_id' => $type_C,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPMOTHER"},{"data1":"MALE","data2":"TYPE_STEPFATHER"}]',
            ),                 
            3 => 
            array (
                'type'      => 'TYPE_STEPDAUGHTER',
                'label'     => '{"es": "Hijastra"}',
                'parent_id' => $type_C,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPMOTHER"},{"data1":"MALE","data2":"TYPE_STEPFATHER"}]',
            ),                 
        ));

    //Insertar parent relative
        $type_R = ContentType::where('type', 'TYPE_RELATIVE')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_BROTHER',
                'label'     => '{"es": "Hermano"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_SISTER"},{"data1":"MALE","data2":"TYPE_BROTHER"}]',
            ),               
            1 => 
            array (
                'type'      => 'TYPE_SISTER',
                'label'     => '{"es": "Hermana"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_SISTER"},{"data1":"MALE","data2":"TYPE_BROTHER"}]',
            ),     
            2 => 
            array (
                'type'      => 'TYPE_GRANDFATHER',
                'label'     => '{"es": "Abuelo"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDDAUGHTER"},{"data1":"MALE","data2":"TYPE_GRANDSON"}]',
            ),          
            3 => 
            array (
                'type'      => 'TYPE_GRANDMATHER',
                'label'     => '{"es": "Abuela"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDDAUGHTER"},{"data1":"MALE","data2":"TYPE_GRANDSON"}]',
            ),                 
            4 => 
            array (
                'type'      => 'TYPE_SONINLAW',
                'label'     => '{"es": "Yerno"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHERINLAW"},{"data1":"MALE","data2":"TYPE_FATHERINLAW"}]',
            ),               
            5 => 
            array (
                'type'      => 'TYPE_DAUGHTERINLAW',
                'label'     => '{"es": "Nuera"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHERINLAW"},{"data1":"MALE","data2":"TYPE_FATHERINLAW"}]',
            ),     
            6 => 
            array (
                'type'      => 'TYPE_UNCLE',
                'label'     => '{"es": "Tío"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),          
            7 => 
            array (
                'type'      => 'TYPE_AUNT',
                'label'     => '{"es": "Tía"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation"}',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),                 
            8 => 
            array (
                'type'      => 'TYPE_GRANDSON',
                'label'     => '{"es": "Nieto"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDMATHER"},{"data1":"MALE","data2":"TYPE_GRANDFATHER"}]',
            ),          
            9 => 
            array (
                'type'      => 'TYPE_GRANDDAUGHTER',
                'label'     => '{"es": "Nieta"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDMATHER"},{"data1":"MALE","data2":"TYPE_GRANDFATHER"}]',
            ),          
            10 => 
            array (
                'type'      => 'TYPE_FATHERINLAW',
                'label'     => '{"es": "Suegro"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTERINLAW"},{"data1":"MALE","data2":"TYPE_SONINLAW"}]',
            ),          
            11 => 
            array (
                'type'      => 'TYPE_MOTHERINLAW',
                'label'     => '{"es": "Suegra"}',
                'parent_id' => $type_R,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTERINLAW"},{"data1":"MALE","data2":"TYPE_SONINLAW"}]',
            ),
        ));

    //Insertar parent otros
        $type_O = ContentType::where('type', 'TYPE_OTHERS')->firstOrFail()->id;
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'TYPE_ASSISTANT',
                'label'     => '{"es": "Asistente"}',
                'parent_id' => $type_O,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            1 => 
            array (
                'type'      => 'TYPE_FRIEND',
                'label'     => '{"es": "Amigo/a"}',
                'parent_id' => $type_O,
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_FRIEND"},{"data1":"MALE","data2":"TYPE_FRIEND"}]',
            ),     
        ));
    }
}
