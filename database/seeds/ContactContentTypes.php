<?php
//para insertar estos datos a la db :php artisan db:seed --class=ContactContentTypes
use Illuminate\Database\Seeder;

class ContactContentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('content_types')->truncate();
        
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'type'      => 'Status',
                'label'     => 'Estado',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Status',
                'lft'       => '2',
                'rgt'       => '17',
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'Event',
                'label'     => 'Evento',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Event',
                'lft'       => '38',
                'rgt'       => '45',
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'Document',
                'label'     => 'Documento',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Document',
                'lft'       => '46',
                'rgt'       => '55',
                'extras'    => '',
            ),
            3 =>            
            array (
                'type'      => 'Sex',
                'label'     => 'Sexo',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Sex',
                'lft'       => '32',
                'rgt'       => '37',
                'extras'    => '',
            ),
            4 =>            
            array (
                'type'      => 'Phone',
                'label'     => 'Teléfono',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Phone',
                'lft'       => '56',
                'rgt'       => '67',
                'extras'    => '',                
            ),
            5 =>            
            array (
                'type'      => 'Email',
                'label'     => 'Correo electrónico',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Email',
                'lft'       => '76',
                'rgt'       => '85',
                'extras'    => '',
            ),
            6 =>            
            array (
                'type'      => 'Address',
                'label'     => 'Dirección',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Address',
                'lft'       => '68',
                'rgt'       => '75',
                'extras'    => '',
            ),
            7 =>            
            array (
                'type'      => 'Blood',
                'label'     => 'Grupo Sanguineo',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Blood',
                'lft'       => '86',
                'rgt'       => '103',
                'extras'    => '',
            ),
            8 =>            
            array (
                'type'      => 'Relation',
                'label'     => 'Relación',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Relation',
                'lft'       => '104',
                'rgt'       => '167',
                'extras'    => '',
            ),
            9 =>            
            array (
                'type'      => 'Civil_Status',
                'label'     => 'Estado Civil',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Civil_Status',
                'lft'       => '18',
                'rgt'       => '31',
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => 'Casa',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => '57',
                'rgt'       => '58',
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'TYPE_MOBILE',
                'label'     => 'Movil',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => '59',
                'rgt'       => '60',
                'extras'    => '',
            ),
            12 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => 'Trabajo',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => '61',
                'rgt'       => '62',
                'extras'    => '',
            ),
            13 => 
            array (
                'type'      => 'TYPE_FAX_WORK',
                'label'     => 'Fax_Trabajo',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => '63',
                'rgt'       => '64',
                'extras'    => '',
            ),
            14 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => 'Otro',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => '65',
                'rgt'       => '66',
                'extras'    => '',
            ),
            15 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => 'Personal',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => '77',
                'rgt'       => '78',
                'extras'    => '',
            ),     
            16 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => 'Trabajo',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'system',
                'lft'       => '79',
                'rgt'       => '80',
                'extras'    => '',
            ),                 
            17 => 
            array (
                'type'      => 'TYPE_MOBILE',
                'label'     => 'Movil',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => '81',
                'rgt'       => '82',
                'extras'    => '',
            ),               
            18 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => 'Otro',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => '83',
                'rgt'       => '84',
                'extras'    => '',
            ),     
            19 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => 'Casa',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => '69',
                'rgt'       => '70',
                'extras'    => '',
            ),     
            20 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => 'Trabajo',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => '71',
                'rgt'       => '72',
                'extras'    => '',
            ),                 
            21 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => 'Otro',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => '73',
                'rgt'       => '74',
                'extras'    => '',
            ),               
            22 => 
            array (
                'type'      => 'TYPE_BIRTHDAY',
                'label'     => 'Nacimiento',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => '39',
                'rgt'       => '40',
                'extras'    => '',
            ),
            23 => 
            array (
                'type'      => 'TYPE_ANNIVERSARY',
                'label'     => 'Aniversario',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => '41',
                'rgt'       => '42',
                'extras'    => '',
            ),
            24 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => 'Otro',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => '43',
                'rgt'       => '44',
                'extras'    => '',
            ),
            25 => 
            array (
                'type'      => 'TYPE_DOC',
                'label'     => 'Documento',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => '47',
                'rgt'       => '48',
                'extras'    => '',
            ),     
            26 => 
            array (
                'type'      => 'TYPE_CUIL',
                'label'     => 'CUIL',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => '49',
                'rgt'       => '50',
                'extras'    => '',
            ),                 
            27 => 
            array (
                'type'      => 'TYPE_PASS',
                'label'     => 'Pasaporte',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'system',
                'lft'       => '51',
                'rgt'       => '52',
                'extras'    => '',
            ),               
            28 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => 'Otro',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => '53',
                'rgt'       => '54',
                'extras'    => '',
            ),     
            29 => 
            array (
                'type'      => 'FEMALE',
                'label'     => 'Femenino',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype'  => 'Sex',
                'lft'       => '33',
                'rgt'       => '34',
                'extras'    => '',
            ),               
            30 => 
            array (
                'type'      => 'MALE',
                'label'     => 'Masculino',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype'  => 'Sex',
                'lft'       => '35',
                'rgt'       => '36',
                'extras'    => '',
            ),     
            31 => 
            array (
                'type'      => 'START',
                'label'     => 'Inicial',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '3',
                'rgt'       => '4',
                'extras'    => '',
            ),     
            32 => 
            array (
                'type'      => 'MEMBER',
                'label'     => 'Miembro',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '5',
                'rgt'       => '6',
                'extras'    => '',
            ),     
            33 => 
            array (
                'type'      => 'CONCURRENT',
                'label'     => 'Concurrente',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '7',
                'rgt'       => '8',
                'extras'    => '',
            ),     
            34 => 
            array (
                'type'      => 'TRANSFER',
                'label'     => 'Traslado',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '9',
                'rgt'       => '10',
                'extras'    => '',
            ),     
            35 => 
            array (
                'type'  => 'MISSING',
                'label'     => 'Auscente',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '11',
                'rgt'       => '12',
                'extras'    => '',
            ),     
            36 => 
            array (
                'type'      => 'DEAD',
                'label'     => 'Fallecido',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '13',
                'rgt'       => '14',
                'extras'    => '',
            ),     
            37 => 
            array (
                'type'      => 'OTHER',
                'label'     => 'Otro',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => '15',
                'rgt'       => '16',
                'extras'    => '',
            ),
            38 => 
            array (
                'type'      => 'SINGLE',
                'label'     => 'Soltero/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '19',
                'rgt'       => '20',
                'extras'    => '',
            ),
            39 => 
            array (
                'type'      => 'MARRIED',
                'label'     => 'Casado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '21',
                'rgt'       => '22',
                'extras'    => '',
            ),
            40 => 
            array (
                'type'      => 'WIDOWED',
                'label'     => 'Viudo/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '23',
                'rgt'       => '24',
                'extras'    => '',
            ),
            41 => 
            array (
                'type'      => 'DIVORCED',
                'label'     => 'Divorciado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '25',
                'rgt'       => '26',
                'extras'    => '',
            ),
            42 => 
            array (
                'type'      => 'SEPARATED',
                'label'     => 'Separado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '27',
                'rgt'       => '28',
                'extras'    => '',
            ),
            43 => 
            array (
                'type'      => 'COHABITING',
                'label'     => 'Conviviente',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => '29',
                'rgt'       => '30',
                'extras'    => '',
            ),
            44 => 
            array (
                'type'      => 'TYPE_PARENT',
                'label'     => 'Padres',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => '105',
                'rgt'       => '114',
                'extras'    => '',
            ),
            45 => 
            array (
                'type'      => 'TYPE_SPOUSE',
                'label'     => 'Conyugue',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => '115',
                'rgt'       => '124',
                'extras'    => '',
            ),
            46 => 
            array (
                'type'      => 'TYPE_CHILDREN',
                'label'     => 'Hijos',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => '125',
                'rgt'       => '134',
                'extras'    => '',
            ),     
            47 => 
            array (
                'type'      => 'TYPE_RELATIVE',
                'label'     => 'Familiares',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => '135',
                'rgt'       => '160',
                'extras'    => '',
            ),
            48 => 
            array (
                'type'      => 'TYPE_OTHERS',
                'label'     => 'Otros',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype'  => 'Relation',
                'lft'       => '161',
                'rgt'       => '166',
                'extras'    => '',
            ),

            49 => 
            array (
                'type'      => 'TYPE_FATHER',
                'label'     => 'Padre',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '106',
                'rgt'       => '107',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTER"},{"data1":"MALE","data2":"TYPE_SON"}]',
            ),
            50 => 
            array (
                'type'      => 'TYPE_MOTHER',
                'label'     => 'Madre',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '108',
                'rgt'       => '109',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTER"},{"data1":"MALE","data2":"TYPE_SON"}]',
            ),
            51 => 
            array (
                'type'      => 'TYPE_STEPFATHER',
                'label'     => 'Padrastro',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '110',
                'rgt'       => '111',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPDAUGHTER"},{"data1":"MALE","data2":"TYPE_STEPSON"}]',
            ),
            52 => 
            array (
                'type'      => 'TYPE_STEPMOTHER',
                'label'     => 'Madrastra',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '112',
                'rgt'       => '113',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPDAUGHTER"},{"data1":"MALE","data2":"TYPE_STEPSON"}]',
            ),

            53 => 
            array (
                'type'      => 'TYPE_HUSBAND',
                'label'     => 'Esposo',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '116',
                'rgt'       => '117',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_WIFE"}]',
            ),
            54 => 
            array (
                'type'      => 'TYPE_WIFE',
                'label'     => 'Esposa',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '118',
                'rgt'       => '119',
                'extras'    => '[{"data1":"MALE","data2":"TYPE_HUSBAND"}]',
            ),
            55 => 
            array (
                'type'      => 'TYPE_EXHUSBAND',
                'label'     => 'ExEsposo',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '120',
                'rgt'       => '121',
                'extras'    => '',
            ),
            56 => 
            array (
                'type'      => 'TYPE_EXWIFE',
                'label'     => 'ExEsposa',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '122',
                'rgt'       => '123',
                'extras'    => '',
            ),
            57 => 
            array (
                'type'      => 'TYPE_SON',
                'label'     => 'Hijo',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '126',
                'rgt'       => '127',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHER"},{"data1":"MALE","data2":"TYPE_FATHER"}]',
            ),                 
            58 => 
            array (
                'type'      => 'TYPE_DAUGHTER',
                'label'     => 'Hija',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '128',
                'rgt'       => '129',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHER"},{"data1":"MALE","data2":"TYPE_FATHER"}]',
            ),                 
            59 => 
            array (
                'type'      => 'TYPE_STEPSON',
                'label'     => 'Hijastro',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '130',
                'rgt'       => '131',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPMOTHER"},{"data1":"MALE","data2":"TYPE_STEPFATHER"}]',
            ),                 
            60 => 
            array (
                'type'      => 'TYPE_STEPDAUGHTER',
                'label'     => 'Hijastra',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '132',
                'rgt'       => '133',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_STEPMOTHER"},{"data1":"MALE","data2":"TYPE_STEPFATHER"}]',
            ),                 
            61 => 
            array (
                'type'      => 'TYPE_BROTHER',
                'label'     => 'Hermano',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '136',
                'rgt'       => '137',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_SISTER"},{"data1":"MALE","data2":"TYPE_BROTHER"}]',
            ),               
            62 => 
            array (
                'type'      => 'TYPE_SISTER',
                'label'     => 'Hermana',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '138',
                'rgt'       => '139',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_SISTER"},{"data1":"MALE","data2":"TYPE_BROTHER"}]',
            ),     
            63 => 
            array (
                'type'      => 'TYPE_GRANDFATHER',
                'label'     => 'Abuelo',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '140',
                'rgt'       => '141',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDDAUGHTER"},{"data1":"MALE","data2":"TYPE_GRANDSON"}]',
            ),          
            64 => 
            array (
                'type'      => 'TYPE_GRANDMATHER',
                'label'     => 'Abuela',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '142',
                'rgt'       => '143',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDDAUGHTER"},{"data1":"MALE","data2":"TYPE_GRANDSON"}]',
            ),                 
            65 => 
            array (
                'type'      => 'TYPE_SONINLAW',
                'label'     => 'Yerno',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '152',
                'rgt'       => '153',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHERINLAW"},{"data1":"MALE","data2":"TYPE_FATHERINLAW"}]',
            ),               
            66 => 
            array (
                'type'      => 'TYPE_DAUGHTERINLAW',
                'label'     => 'Nuera',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '154',
                'rgt'       => '155',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_MOTHERINLAW"},{"data1":"MALE","data2":"TYPE_FATHERINLAW"}]',
            ),     
            67 => 
            array (
                'type'      => 'TYPE_UNCLE',
                'label'     => 'Tío',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '156',
                'rgt'       => '157',
                'extras'    => '',
            ),          
            68 => 
            array (
                'type'      => 'TYPE_AUNT',
                'label'     => 'Tía',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '158',
                'rgt'       => '159',
                'extras'    => '',
            ),                 

            69 => 
            array (
                'type'      => 'TYPE_ASSISTANT',
                'label'     => 'Asistente',
                'parent_id' => '49',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '164',
                'rgt'       => '165',
                'extras'    => '',
            ),     
            70 => 
            array (
                'type'      => 'TYPE_FRIEND',
                'label'     => 'Amigo/a',
                'parent_id' => '49',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '162',
                'rgt'       => '163',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_FRIEND"},{"data1":"MALE","data2":"TYPE_FRIEND"}]',
            ),     
            71 => 
            array (
                'type'      => 'GROUP_A+',
                'label'     => 'Grupo A+',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '87',
                'rgt'       => '88',
                'extras'    => '',
            ),
            72 => 
            array (
                'type'      => 'GROUP_B+',
                'label'     => 'Grupo B+',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '89',
                'rgt'       => '90',
                'extras'    => '',
            ),
            73 => 
            array (
                'type'      => 'GROUP_AB+',
                'label'     => 'Grupo AB+',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '91',
                'rgt'       => '92',
                'extras'    => '',
            ),
            74 => 
            array (
                'type'      => 'GROUP_0+',
                'label'     => 'Grupo 0+',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '93',
                'rgt'       => '94',
                'extras'    => '',
            ),
            75 => 
            array (
                'type'      => 'GROUP_A-',
                'label'     => 'Grupo A-',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '95',
                'rgt'       => '96',
                'extras'    => '',
            ),     
            76 => 
            array (
                'type'      => 'GROUP_B-',
                'label'     => 'Grupo B-',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '97',
                'rgt'       => '98',
                'extras'    => '',
            ),                 
            77 => 
            array (
                'type'      => 'GROUP_AB-',
                'label'     => 'Grupo AB-',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '99',
                'rgt'       => '100',
                'extras'    => '',
            ),         
            78 => 
            array (
                'type'      => 'GROUP_0-',
                'label'     => 'Grupo 0-',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => '101',
                'rgt'       => '102',
                'extras'    => '',
            ),
            79 => 
            array (
                'type'      => 'TYPE_GRANDSON',
                'label'     => 'Nieto',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '144',
                'rgt'       => '145',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDMATHER"},{"data1":"MALE","data2":"TYPE_GRANDFATHER"}]',
            ),          

            80 => 
            array (
                'type'      => 'TYPE_GRANDDAUGHTER',
                'label'     => 'Nieta',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '146',
                'rgt'       => '147',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_GRANDMATHER"},{"data1":"MALE","data2":"TYPE_GRANDFATHER"}]',
            ),          
            81 => 
            array (
                'type'      => 'TYPE_FATHERINLAW',
                'label'     => 'Suegro',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '148',
                'rgt'       => '149',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTERINLAW"},{"data1":"MALE","data2":"TYPE_SONINLAW"}]',
            ),          
            82 => 
            array (
                'type'      => 'TYPE_MOTHERINLAW',
                'label'     => 'Suegra',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype'  => 'Relation',
                'lft'       => '150',
                'rgt'       => '151',
                'extras'    => '[{"data1":"FEMALE","data2":"TYPE_DAUGHTERINLAW"},{"data1":"MALE","data2":"TYPE_SONINLAW"}]',
            ),

        ));
    }
}
