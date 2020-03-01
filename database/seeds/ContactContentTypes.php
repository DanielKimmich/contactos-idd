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
        \DB::table('content_types')->delete();
        
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'mimetype' => 'Phone',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Casa',
            ),
            1 => 
            array (
                'mimetype' => 'Phone',
                'type' => 'TYPE_MOBILE',
                'order' => '2',
                'label' => 'Movil',
            ),
            2 => 
            array (
                'mimetype' => 'Phone',
                'type' => 'TYPE_WORK',
                'order' => '3',
                'label' => 'Trabajo',
            ),
            3 => 
            array (
                'mimetype' => 'Phone',
                'type' => 'TYPE_FAX_WORK',
                'order' => '4',
                'label' => 'Fax_Trabajo',
            ),
            4 => 
            array (
                'mimetype' => 'Phone',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),
            5 => 
            array (
                'mimetype' => 'Email',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Personal',
            ),     
            6 => 
            array (
                'mimetype' => 'Email',
                'type' => 'TYPE_WORK',
                'order' => '2',
                'label' => 'Trabajo',
            ),                 
            7 => 
            array (
                'mimetype' => 'Email',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),               
            8 => 
            array (
                'mimetype' => 'Email',
                'type' => 'TYPE_MOBILE',
                'order' => '3',
                'label' => 'Movil',
            ),     
            9 => 
            array (
                'mimetype' => 'Address',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Casa',
            ),     
            10 => 
            array (
                'mimetype' => 'Address',
                'type' => 'TYPE_WORK',
                'order' => '2',
                'label' => 'Trabajo',
            ),                 
            11 => 
            array (
                'mimetype' => 'Address',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),               
            12 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_FATHER',
                'order' => '1',
                'label' => 'Padre',
            ),
            13 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_MOTHER',
                'order' => '2',
                'label' => 'Madre',
            ),
            14 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_SPOUSE',
                'order' => '3',
                'label' => 'Conyugue',
            ),
            15 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TTYPE_CHILD',
                'order' => '4',
                'label' => 'Hijo/a',
            ),     
            16 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_DOMESTIC_PARTNER',
                'order' => '5',
                'label' => 'Hijastro/a',
            ),                 
            17 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_BROTHER',
                'order' => '6',
                'label' => 'Hermano',
            ),               
            18 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_SISTER',
                'order' => '7',
                'label' => 'Hermana',
            ),     
            19 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_RELATIVE',
                'order' => '8',
                'label' => 'Otro Familiar',
            ),     
            20 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_ASSISTANT',
                'order' => '9',
                'label' => 'Asistente',
            ),     
            21 => 
            array (
                'mimetype' => 'Relation',
                'type' => 'TYPE_FRIEND',
                'order' => '10',
                'label' => 'Amigo/a',
            ),     
            22 => 
            array (
                'mimetype' => 'Event',
                'type' => 'TYPE_BIRTHDAY',
                'order' => '1',
                'label' => 'Nacimiento',
            ),
            23 => 
            array (
                'mimetype' => 'Event',
                'type' => 'TYPE_ANNIVERSARY',
                'order' => '2',
                'label' => 'Aniversario',
            ),
            24 => 
            array (
                'mimetype' => 'Event',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),
            25 => 
            array (
                'mimetype' => 'Document',
                'type' => 'TYPE_DOC',
                'order' => '1',
                'label' => 'Documento',
            ),     
            26 => 
            array (
                'mimetype' => 'Document',
                'type' => 'TYPE_CUIL',
                'order' => '2',
                'label' => 'CUIL',
            ),                 
            27 => 
            array (
                'mimetype' => 'Document',
                'type' => 'TYPE_PASS',
                'order' => '3',
                'label' => 'Pasaporte',
            ),               
            28 => 
            array (
                'mimetype' => 'Document',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),     
            29 => 
            array (
                'mimetype' => 'Sexo',
                'type' => 'FEMALE',
                'order' => '1',
                'label' => 'Femenino',
            ),               
            30 => 
            array (
                'mimetype' => 'Sexo',
                'type' => 'MALE',
                'order' => '2',
                'label' => 'Masculino',
            ),     


        ));
        
     
    }
}
