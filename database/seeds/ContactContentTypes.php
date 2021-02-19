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
                'label'     => '{"es": "Estado"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            1 => 
            array (
                'type'      => 'Event',
                'label'     => '{"es": "Evento"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Event',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            2 => 
            array (
                'type'      => 'Document',
                'label'     => '{"es": "Documento"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Document',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            3 =>            
            array (
                'type'      => 'Sex',
                'label'     => '{"es": "Sexo"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Sex',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            4 =>            
            array (
                'type'      => 'Phone',
                'label'     => '{"es": "Teléfono"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',                
            ),
            5 =>            
            array (
                'type'      => 'Email',
                'label'     => '{"es": "Correo electrónico"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Email',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            6 =>            
            array (
                'type'      => 'Address',
                'label'     => '{"es": "Dirección"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Address',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            7 =>            
            array (
                'type'      => 'Blood',
                'label'     => '{"es": "Grupo Sanguineo"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            8 =>            
            array (
                'type'      => 'Study',
                'label'     => '{"es": "Estudio"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Study',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            9 =>            
            array (
                'type'      => 'Civil_Status',
                'label'     => '{"es": "Estado Civil"}',
                'parent_id' => '0',
                'depth'     => '1',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            10 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => '{"es": "Casa"}',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            11 => 
            array (
                'type'      => 'TYPE_MOBILE',
                'label'     => '{"es": "Movil"}',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            12 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => '{"es": "Trabajo"}',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            13 => 
            array (
                'type'      => 'TYPE_FAX_WORK',
                'label'     => '{"es": "Fax_Trabajo"}',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            14 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '5',
                'depth'     => '2',
                'mimetype'  => 'Phone',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            15 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => '{"es": "Personal"}',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            16 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => '{"es": "Trabajo"}',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),                 
            17 => 
            array (
                'type'      => 'TYPE_MOBILE',
                'label'     => '{"es": "Movil"}',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),               
            18 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '6',
                'depth'     => '2',
                'mimetype'  => 'Email',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            19 => 
            array (
                'type'      => 'TYPE_HOME',
                'label'     => '{"es": "Casa"}',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            20 => 
            array (
                'type'      => 'TYPE_WORK',
                'label'     => '{"es": "Trabajo"}',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),                 
            21 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '7',
                'depth'     => '2',
                'mimetype'  => 'Address',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),               
            22 => 
            array (
                'type'      => 'TYPE_BIRTHDAY',
                'label'     => '{"es": "Nacimiento"}',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            23 => 
            array (
                'type'      => 'TYPE_ANNIVERSARY',
                'label'     => '{"es": "Aniversario"}',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            24 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '2',
                'depth'     => '2',
                'mimetype'  => 'Event',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            25 => 
            array (
                'type'      => 'TYPE_DOC',
                'label'     => '{"es": "Documento"}',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            26 => 
            array (
                'type'      => 'TYPE_CUIL',
                'label'     => '{"es": "CUIL"}',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),                 
            27 => 
            array (
                'type'      => 'TYPE_PASS',
                'label'     => '{"es": "Pasaporte"}',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),               
            28 => 
            array (
                'type'      => 'TYPE_OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '3',
                'depth'     => '2',
                'mimetype'  => 'Document',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            29 => 
            array (
                'type'      => 'FEMALE',
                'label'     => '{"es": "Femenino"}',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype'  => 'Sex',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),               
            30 => 
            array (
                'type'      => 'MALE',
                'label'     => '{"es": "Masculino"}',
                'parent_id' => '4',
                'depth'     => '2',
                'mimetype'  => 'Sex',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            31 => 
            array (
                'type'      => 'START',
                'label'     => '{"es": "Inicial"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            32 => 
            array (
                'type'      => 'MEMBER',
                'label'     => '{"es": "Miembro"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            33 => 
            array (
                'type'      => 'CONCURRENT',
                'label'     => '{"es": "Concurrente"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            34 => 
            array (
                'type'      => 'TRANSFER',
                'label'     => '{"es": "Traslado"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            35 => 
            array (
                'type'      => 'MISSING',
                'label'     => '{"es": "Auscente"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            36 => 
            array (
                'type'      => 'DEAD',
                'label'     => '{"es": "Fallecido"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            37 => 
            array (
                'type'      => 'OTHER',
                'label'     => '{"es": "Otro"}',
                'parent_id' => '1',
                'depth'     => '2',
                'mimetype'  => 'Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            38 => 
            array (
                'type'      => 'SINGLE',
                'label'     => '{"es": "Soltero/a"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            39 => 
            array (
                'type'      => 'MARRIED',
                'label'     => '{"es": "Casado/a"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            40 => 
            array (
                'type'      => 'WIDOWED',
                'label'     => '{"es": "Viudo/a"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            41 => 
            array (
                'type'      => 'DIVORCED',
                'label'     => '{"es": "Divorciado/a"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            42 => 
            array (
                'type'      => 'SEPARATED',
                'label'     => '{"es": "Separado/a"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            43 => 
            array (
                'type'      => 'COHABITING',
                'label'     => '{"es": "Conviviente"}',
                'parent_id' => '10',
                'depth'     => '2',
                'mimetype'  => 'Civil_Status',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

            44 => 
            array (
                'type'      => 'GROUP_A+',
                'label'     => '{"es": "Grupo A+"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            45 => 
            array (
                'type'      => 'GROUP_B+',
                'label'     => '{"es": "Grupo B+"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            46 => 
            array (
                'type'      => 'GROUP_AB+',
                'label'     => '{"es": "Grupo AB+"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            47 => 
            array (
                'type'      => 'GROUP_0+',
                'label'     => '{"es": "Grupo 0+"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),
            48 => 
            array (
                'type'      => 'GROUP_A-',
                'label'     => '{"es": "Grupo A-"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),     
            49 => 
            array (
                'type'      => 'GROUP_B-',
                'label'     => '{"es": "Grupo B-"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),                 
            50 => 
            array (
                'type'      => 'GROUP_AB-',
                'label'     => '{"es": "Grupo AB-"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),         
            51 => 
            array (
                'type'      => 'GROUP_0-',
                'label'     => '{"es": "Grupo 0-"}',
                'parent_id' => '8',
                'depth'     => '2',
                'mimetype'  => 'Blood',
                'lft'       => null,
                'rgt'       => null,
                'extras'    => '',
            ),

        ));
    }
}
