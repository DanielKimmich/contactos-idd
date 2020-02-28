<?php

use Illuminate\Database\Seeder;
use Khsing\World\Models\Country;

class ArgentinaDivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        $pais = Country::where('code', 'ar')->firstOrFail()->id;
        \DB::table('world_divisions')->where('country_id', '=', $pais)->delete();
 
        \DB::table('world_divisions')->insert(array (
             0 => 
            array (
                'country_id' => $pais,
                'name' => 'Misiones',
                'full_name' => 'Provincia de Misiones',
                'code' => 'AR-N',
                'has_city' => 1,
            ),
            1 => 
            array (
                'country_id' => $pais,
                'name' => 'San Luis',
                'full_name' => 'Provincia de San Luis',
                'code' => 'AR-D',
                'has_city' => 1,
            ),
            2 => 
            array (
                'country_id' => $pais,
                'name' => 'San Juan',
                'full_name' => 'Provincia de San Juan',
                'code' => 'AR-J',
                'has_city' => 1,
            ),
            3 => 
            array (
                'country_id' => $pais,
                'name' => 'Entre Ríos',
                'full_name' => 'Provincia de Entre Ríos',
                'code' => 'AR-E',
                'has_city' => 1,
            ),
            4 => 
            array (
                'country_id' => $pais,
                'name' => 'Santa Cruz',
                'full_name' => 'Provincia de Santa Cruz',
                'code' => 'AR-Z',
                'has_city' => 1,
            ),
            5 => 
            array (
                'country_id' => $pais,
                'name' => 'Río Negro',
                'full_name' => 'Provincia de Río Negro',
                'code' => 'AR-R',
                'has_city' => 1,
            ),
            6 => 
            array (
                'country_id' => $pais,
                'name' => 'Chubut',
                'full_name' => 'Provincia del Chubut',
                'code' => 'AR-U',
                'has_city' => 1,
            ),
            7 => 
            array (
                'country_id' => $pais,
                'name' => 'Córdoba',
                'full_name' => 'Provincia de Córdoba',
                'code' => 'AR-X',
                'has_city' => 1,
            ),
            8 => 
            array (
                'country_id' => $pais,
                'name' => 'Mendoza',
                'full_name' => 'Provincia de Mendoza',
                'code' => 'AR-M',
                'has_city' => 1,
            ),
            9 => 
            array (
                'country_id' => $pais,
                'name' => 'La Rioja',
                'full_name' => 'Provincia de La Rioja',
                'code' => 'AR-F',
                'has_city' => 1,
            ),
            10 => 
            array (
                'country_id' => $pais,
                'name' => 'Catamarca',
                'full_name' => 'Provincia de Catamarca',
                'code' => 'AR-K',
                'has_city' => 1,
            ),
            11 => 
            array (
                'country_id' => $pais,
                'name' => 'La Pampa',
                'full_name' => 'Provincia de La Pampa',
                'code' => 'AR-L',
                'has_city' => 1,
            ),
            12 => 
            array (
                'country_id' => $pais,
                'name' => 'Santiago del Estero',
                'full_name' => 'Provincia de Santiago del Estero',
                'code' => 'AR-G',
                'has_city' => 1,
            ),
            13 => 
            array (
                'country_id' => $pais,
                'name' => 'Corrientes',
                'full_name' => 'Provincia de Corrientes',
                'code' => 'AR-W',
                'has_city' => 1,
            ),
            14 => 
            array (
                'country_id' => $pais,
                'name' => 'Santa Fe',
                'full_name' => 'Provincia de Santa Fe',
                'code' => 'AR-S',
                'has_city' => 1,
            ),
            15 => 
            array (
                'country_id' => $pais,
                'name' => 'Tucumán',
                'full_name' => 'Provincia de Tucumán',
                'code' => 'AR-T',
                'has_city' => 1,
            ),
            16 => 
            array (
                'country_id' => $pais,
                'name' => 'Neuquén',
                'full_name' => 'Provincia del Neuquén',
                'code' => 'AR-Q',
                'has_city' => 1,
            ),
            17 => 
            array (
                'country_id' => $pais,
                'name' => 'Salta',
                'full_name' => 'Provincia de Salta',
                'code' => 'AR-A',
                'has_city' => 1,
            ),
            18 => 
            array (
                'country_id' => $pais,
                'name' => 'Chaco',
                'full_name' => 'Provincia del Chaco',
                'code' => 'AR-H',
                'has_city' => 1,
            ),
            19 => 
            array (
                'country_id' => $pais,
                'name' => 'Formosa',
                'full_name' => 'Provincia de Formosa',
                'code' => 'AR-P',
                'has_city' => 1,
            ),
            20 => 
            array (
                'country_id' => $pais,
                'name' => 'Jujuy',
                'full_name' => 'Provincia de Jujuy',
                'code' => 'AR-Y',
                'has_city' => 1,
            ),
            21 => 
            array (
                'country_id' => $pais,
                'name' => 'Ciudad Autónoma de Buenos Aires',
                'full_name' => 'Ciudad Autónoma de Buenos Aires',
                'code' => 'AR-C',
                'has_city' => 1,
            ),
            22 => 
            array (
                'country_id' => $pais,
                'name' => 'Buenos Aires',
                'full_name' => 'Provincia de Buenos Aires',
                'code' => 'AR-B',
                'has_city' => 1,
            ),
            23 => 
            array (
                'country_id' => $pais,
                'name' => 'Tierra del Fuego',
                'full_name' => 'Provincia de Tierra del Fuego',
                'code' => 'AR-V',
                'has_city' => 1,
            ),
        ));
        
        
    }
}