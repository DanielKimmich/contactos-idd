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
                'mimetype' => 'Name',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            1 => 
            array (
                'mimetype' => 'Phone',
                'alias' => 'name',
                'data_column' => 'data1',                
            ),
            2 => 
            array (
                'mimetype' => 'Email',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            3 => 
            array (
                'mimetype' => 'Organization',
                'alias' => 'name',
                'data_column' => 'data1',
            ),
            4 => 
            array (
                'mimetype' => 'Address',
                'alias' => 'name',
                'data_column' => 'data1',                
            ),
            5 => 
            array (
                'mimetype' => 'Relation',
                'alias' => 'name',
                'data_column' => 'data1',
            ),     
            6 => 
            array (
                'mimetype' => 'Document',
                'alias' => 'name',
                'data_column' => 'data1',
            ),                 
            7 => 
            array (
                'mimetype' => 'WebSite',
                'alias' => 'name',
                'data_column' => 'data1',
            ),     
            8 => 
            array (
                'mimetype' => 'Event',
                'alias' => 'name',
                'data_column' => 'data1',
            ),   
            9 => 
            array (
                'mimetype' => 'Sex',
                'alias' => 'name',
                'data_column' => 'data1',
            ),                 
        ));
        
     
    }
}
