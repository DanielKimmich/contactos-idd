<?php
//para insertar estos datos a la db :php artisan db:seed --class=ContactContentTypes
use Illuminate\Database\Seeder;

class ContactContentAlias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('content_alias')->delete();
        
        \DB::table('content_alias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'mimetype' => 'Name',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            1 => 
            array (
                'id' => 2,
                'mimetype' => 'Phone',
                'alias' => 'name',
                'data_column' => 'data1',                
            ),
            2 => 
            array (
                'id' => 3,
                'mimetype' => 'Email',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            3 => 
            array (
                'id' => 4,
                'mimetype' => 'Organization',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            4 => 
            array (
                'id' => 5,
                'mimetype' => 'Address',
                'alias' => 'name',
                'data_column' => 'data1',                
            ),
            5 => 
            array (
                'id' => 6,
                'mimetype' => 'Relation',
                'alias' => 'name',
                'data_column' => 'data1',
            ),     
            6 => 
            array (
                'id' => 7,
                'mimetype' => 'Document',
                'alias' => 'name',
                'data_column' => 'data1',
            ),                 
            7 => 
            array (
                'id' => 8,
                'mimetype' => 'WebSite',
                'alias' => 'name',
                'data_column' => 'data1',
            ),     
            8 => 
            array (
                'id' => 9,
                'mimetype' => 'Event',
                'alias' => 'name',
                'data_column' => 'data1',
            ),   
            9 => 
            array (
                'id' => 10,
                'mimetype' => 'Sexo',
                'alias' => 'name',
                'data_column' => 'data1',
            ),                 
        ));
        
     
    }
}
