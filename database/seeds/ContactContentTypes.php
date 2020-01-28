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
                'id' => 1,
                'mimetype' => 'Phone',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Casa',
            ),
            1 => 
            array (
                'id' => 2,
                'mimetype' => 'Phone',
                'type' => 'TYPE_MOBILE',
                'order' => '2',
                'label' => 'Movil',
            ),
            2 => 
            array (
                'id' => 3,
                'mimetype' => 'Phone',
                'type' => 'TYPE_WORK',
                'order' => '3',
                'label' => 'Trabajo',
            ),
            3 => 
            array (
                'id' => 4,
                'mimetype' => 'Phone',
                'type' => 'TYPE_FAX_WORK',
                'order' => '4',
                'label' => 'Fax_Trabajo',
            ),
            4 => 
            array (
                'id' => 5,
                'mimetype' => 'Phone',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),
            5 => 
            array (
                'id' => 6,
                'mimetype' => 'Email',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Particular',
            ),     
            6 => 
            array (
                'id' => 7,
                'mimetype' => 'Email',
                'type' => 'TYPE_WORK',
                'order' => '2',
                'label' => 'Trabajo',
            ),                 
            7 => 
            array (
                'id' => 8,
                'mimetype' => 'Email',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),               
            8 => 
            array (
                'id' => 9,
                'mimetype' => 'Email',
                'type' => 'TYPE_MOBILE',
                'order' => '3',
                'label' => 'Movil',
            ),     
            9 => 
            array (
                'id' => 10,
                'mimetype' => 'Address',
                'type' => 'TYPE_HOME',
                'order' => '1',
                'label' => 'Particular',
            ),     
            10 => 
            array (
                'id' => 11,
                'mimetype' => 'Address',
                'type' => 'TYPE_WORK',
                'order' => '2',
                'label' => 'Trabajo',
            ),                 
            11 => 
            array (
                'id' => 12,
                'mimetype' => 'Address',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),               
            12 => 
            array (
                'id' => 13,
                'mimetype' => 'Relation',
                'type' => 'TYPE_FATHER',
                'order' => '1',
                'label' => 'Padre',
            ),
            13 => 
            array (
                'id' => 14,
                'mimetype' => 'Relation',
                'type' => 'TYPE_MOTHER',
                'order' => '2',
                'label' => 'Madre',
            ),
            14 => 
            array (
                'id' => 15,
                'mimetype' => 'Relation',
                'type' => 'TYPE_SPOUSE',
                'order' => '3',
                'label' => 'Conyugue',
            ),
            15 => 
            array (
                'id' => 16,
                'mimetype' => 'Relation',
                'type' => 'TTYPE_CHILD',
                'order' => '4',
                'label' => 'Hijo/a',
            ),     
            16 => 
            array (
                'id' => 17,
                'mimetype' => 'Relation',
                'type' => 'TYPE_DOMESTIC_PARTNER',
                'order' => '5',
                'label' => 'Hijastro/a',
            ),                 
            17 => 
            array (
                'id' => 18,
                'mimetype' => 'Relation',
                'type' => 'TYPE_BROTHER',
                'order' => '6',
                'label' => 'Hermano',
            ),               
            18 => 
            array (
                'id' => 19,
                'mimetype' => 'Relation',
                'type' => 'TYPE_SISTER',
                'order' => '7',
                'label' => 'Hermana',
            ),     
            19 => 
            array (
                'id' => 20,
                'mimetype' => 'Relation',
                'type' => 'TYPE_RELATIVE',
                'order' => '8',
                'label' => 'Otro Familiar',
            ),     
            20 => 
            array (
                'id' => 21,
                'mimetype' => 'Relation',
                'type' => 'TYPE_ASSISTANT',
                'order' => '9',
                'label' => 'Asistente',
            ),     
            21 => 
            array (
                'id' => 22,
                'mimetype' => 'Relation',
                'type' => 'TYPE_FRIEND',
                'order' => '10',
                'label' => 'Amigo/a',
            ),     
            22 => 
            array (
                'id' => 23,
                'mimetype' => 'Event',
                'type' => 'TYPE_BIRTHDAY',
                'order' => '1',
                'label' => 'Nacimiento',
            ),
            23 => 
            array (
                'id' => 24,
                'mimetype' => 'Event',
                'type' => 'TYPE_ANNIVERSARY',
                'order' => '2',
                'label' => 'Aniversario',
            ),
            24 => 
            array (
                'id' => 25,
                'mimetype' => 'Event',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),
            25 => 
            array (
                'id' => 26,
                'mimetype' => 'Document',
                'type' => 'TYPE_DOC',
                'order' => '1',
                'label' => 'Documento',
            ),     
            26 => 
            array (
                'id' => 27,
                'mimetype' => 'Document',
                'type' => 'TYPE_CUIL',
                'order' => '2',
                'label' => 'CUIL',
            ),                 
            27 => 
            array (
                'id' => 28,
                'mimetype' => 'Document',
                'type' => 'TYPE_PASS',
                'order' => '3',
                'label' => 'Pasaporte',
            ),               
            28 => 
            array (
                'id' => 29,
                'mimetype' => 'Document',
                'type' => 'TYPE_OTHER',
                'order' => '9',
                'label' => 'Otro',
            ),     



        ));
        
     
    }
}
