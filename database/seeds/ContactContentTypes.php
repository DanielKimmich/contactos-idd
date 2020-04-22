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
                'mimetype' => 'system',
            ),
            1 => 
            array (
                'type'      => 'Event',
                'label'     => 'Evento',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            2 => 
            array (
                'type'      => 'Document',
                'label'     => 'Documento',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            3 =>            
            array (
                'type'      => 'Sex',
                'label'     => 'Sexo',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            4 =>            
            array (
                'type'      => 'Phone',
                'label'     => 'Teléfono',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            5 =>            
            array (
                'type'      => 'Email',
                'label'     => 'Correo electrónico',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            6 =>            
            array (
                'type'      => 'Address',
                'label'     => 'Dirección',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            7 =>            
            array (
                'type'      => 'Organization',
                'label'     => 'Organización',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            8 =>            
            array (
                'type'      => 'Relation',
                'label'     => 'Relación',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            9 =>            
            array (
                'type'      => 'Civil_Status',
                'label'     => 'Estado Civil',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype' => 'system',
            ),
            10 => 
            array (
                'type' => 'TYPE_HOME',
                'label' => 'Casa',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            11 => 
            array (
                'type' => 'TYPE_MOBILE',
                'label' => 'Movil',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            12 => 
            array (
                'type' => 'TYPE_WORK',
                'label' => 'Trabajo',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            13 => 
            array (
                'type' => 'TYPE_FAX_WORK',
                'label' => 'Fax_Trabajo',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            14 => 
            array (
                'type' => 'TYPE_OTHER',
                'label' => 'Otro',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            15 => 
            array (
                'type' => 'TYPE_HOME',
                'label' => 'Personal',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            16 => 
            array (
                'type' => 'TYPE_WORK',
                'label' => 'Trabajo',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype' => 'system',
            ),                 
            17 => 
            array (
                'type' => 'TYPE_OTHER',
                'label' => 'Otro',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype' => 'system',
            ),               
            18 => 
            array (
                'type' => 'TYPE_MOBILE',
                'label' => 'Movil',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            19 => 
            array (
                'type' => 'TYPE_HOME',
                'label' => 'Casa',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            20 => 
            array (
                'type' => 'TYPE_WORK',
                'label' => 'Trabajo',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype' => 'system',
            ),                 
            21 => 
            array (
                'type' => 'TYPE_OTHER',
                'label' => 'Otro',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype' => 'system',
            ),               
            22 => 
            array (
                'type' => 'TYPE_BIRTHDAY',
                'label' => 'Nacimiento',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            23 => 
            array (
                'type' => 'TYPE_ANNIVERSARY',
                'label' => 'Aniversario',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            24 => 
            array (
                'type' => 'TYPE_OTHER',
                'label' => 'Otro',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            25 => 
            array (
                'type' => 'TYPE_DOC',
                'label' => 'Documento',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            26 => 
            array (
                'type' => 'TYPE_CUIL',
                'label' => 'CUIL',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype' => 'system',
            ),                 
            27 => 
            array (
                'type' => 'TYPE_PASS',
                'label' => 'Pasaporte',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype' => 'system',
            ),               
            28 => 
            array (
                'type' => 'TYPE_OTHER',
                'label' => 'Otro',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            29 => 
            array (
                'type' => 'FEMALE',
                'label' => 'Femenino',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype' => 'system',
            ),               
            30 => 
            array (
                'type' => 'MALE',
                'label' => 'Masculino',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            31 => 
            array (
                'type' => 'START',
                'label' => 'Inicial',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            32 => 
            array (
                'type' => 'MEMBER',
                'label' => 'Miembro',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            33 => 
            array (
                'type' => 'CONCURRENT',
                'label' => 'Concurrente',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            34 => 
            array (
                'type' => 'TRANSFER',
                'label' => 'Traslado',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            35 => 
            array (
                'type' => 'MISSING',
                'label' => 'Auscente',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            36 => 
            array (
                'type' => 'DEAD',
                'label' => 'Fallecido',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            37 => 
            array (
                'type' => 'OTHER',
                'label' => 'Otro',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            38 => 
            array (
                'type' => 'SINGLE',
                'label' => 'Soltero/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            39 => 
            array (
                'type' => 'MARRIED',
                'label' => 'Casado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            40 => 
            array (
                'type' => 'WIDOWED',
                'label' => 'Viudo/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            41 => 
            array (
                'type' => 'DIVORCED',
                'label' => 'Divorciado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            42 => 
            array (
                'type' => 'SEPARATED',
                'label' => 'Separado/a',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            43 => 
            array (
                'type' => 'COHABITING',
                'label' => 'Conviviente',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            44 => 
            array (
                'type' => 'TYPE_PARENT',
                'label' => 'Padres',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            45 => 
            array (
                'type' => 'TYPE_SPOUSE',
                'label' => 'Conyugue',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            46 => 
            array (
                'type' => 'TYPE_CHILDREN',
                'label' => 'Hijos',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype' => 'system',
            ),     
            47 => 
            array (
                'type' => 'TYPE_RELATIVE',
                'label' => 'Familiares',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            48 => 
            array (
                'type' => 'TYPE_OTHERS',
                'label' => 'Otros',
                'parent_id' => '9',
                'depth'     => '2',
                'mimetype' => 'system',
            ),
            49 => 
            array (
                'type' => 'TYPE_FATHER',
                'label' => 'Padre',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            50 => 
            array (
                'type' => 'TYPE_MOTHER',
                'label' => 'Madre',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            51 => 
            array (
                'type' => 'TYPE_STEPFATHER',
                'label' => 'Padrastro',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            52 => 
            array (
                'type' => 'TYPE_STEPMOTHER',
                'label' => 'Madrastra',
                'parent_id' => '45',
                'depth'     => '3',
                'mimetype' => 'system',
            ),

            53 => 
            array (
                'type' => 'TYPE_HUSBAND',
                'label' => 'Esposo',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            54 => 
            array (
                'type' => 'TYPE_WIFE',
                'label' => 'Esposa',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            55 => 
            array (
                'type' => 'TYPE_EXHUSBAND',
                'label' => 'ExEsposo',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype' => 'system',
            ),
            56 => 
            array (
                'type' => 'TYPE_EXWIFE',
                'label' => 'ExEsposa',
                'parent_id' => '46',
                'depth'     => '3',
                'mimetype' => 'system',
            ),


            57 => 
            array (
                'type' => 'TYPE_SON',
                'label' => 'Hijo',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 
            58 => 
            array (
                'type' => 'TYPE_DAUGHTER',
                'label' => 'Hija',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 
            59 => 
            array (
                'type' => 'TYPE_STEPSON',
                'label' => 'Hijastro',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 
            60 => 
            array (
                'type' => 'TYPE_STEPDAUGHTER',
                'label' => 'Hijastra',
                'parent_id' => '47',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 

            61 => 
            array (
                'type' => 'TYPE_BROTHER',
                'label' => 'Hermano',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),               
            62 => 
            array (
                'type' => 'TYPE_SISTER',
                'label' => 'Hermana',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),     
            63 => 
            array (
                'type' => 'TYPE_GRANDFATHER',
                'label' => 'Abuelo',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),          
            64 => 
            array (
                'type' => 'TYPE_GRANDMATHER',
                'label' => 'Abuela',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 

            65 => 
            array (
                'type' => 'TYPE_SONINLAW',
                'label' => 'Yerno',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),               
            66 => 
            array (
                'type' => 'TYPE_DAUGHTERINLAW',
                'label' => 'Nuera',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),     
            67 => 
            array (
                'type' => 'TYPE_UNCLE',
                'label' => 'Tío',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),          
            68 => 
            array (
                'type' => 'TYPE_AUNT',
                'label' => 'Tía',
                'parent_id' => '48',
                'depth'     => '3',
                'mimetype' => 'system',
            ),                 

            69 => 
            array (
                'type' => 'TYPE_ASSISTANT',
                'label' => 'Asistente',
                'parent_id' => '49',
                'depth'     => '3',
                'mimetype' => 'system',
            ),     
            70 => 
            array (
                'type' => 'TYPE_FRIEND',
                'label' => 'Amigo/a',
                'parent_id' => '49',
                'depth'     => '3',
                'mimetype' => 'system',
            ),     
        ));
    }
}
