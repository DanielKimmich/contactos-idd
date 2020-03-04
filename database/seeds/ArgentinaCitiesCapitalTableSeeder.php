<?php

use Illuminate\Database\Seeder;
use Khsing\World\Models\Country;
use Khsing\World\Models\Division;

class ArgentinaCitiesCapitalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $pais = Country::where('code', 'ar')->firstOrFail()->id;    
        $prov_A = Division::where('code', 'AR-A')->firstOrFail()->id;
        $prov_B = Division::where('code', 'AR-B')->firstOrFail()->id;
        $prov_C = Division::where('code', 'AR-C')->firstOrFail()->id;
        $prov_D = Division::where('code', 'AR-D')->firstOrFail()->id;
        $prov_E = Division::where('code', 'AR-E')->firstOrFail()->id;
        $prov_F = Division::where('code', 'AR-F')->firstOrFail()->id;
        $prov_G = Division::where('code', 'AR-G')->firstOrFail()->id;
        $prov_H = Division::where('code', 'AR-H')->firstOrFail()->id;
        $prov_J = Division::where('code', 'AR-J')->firstOrFail()->id;
        $prov_K = Division::where('code', 'AR-K')->firstOrFail()->id;
        $prov_L = Division::where('code', 'AR-L')->firstOrFail()->id;
        $prov_M = Division::where('code', 'AR-M')->firstOrFail()->id;
        $prov_N = Division::where('code', 'AR-N')->firstOrFail()->id;
        $prov_P = Division::where('code', 'AR-P')->firstOrFail()->id;
        $prov_Q = Division::where('code', 'AR-Q')->firstOrFail()->id;
        $prov_R = Division::where('code', 'AR-R')->firstOrFail()->id;
        $prov_S = Division::where('code', 'AR-S')->firstOrFail()->id;
        $prov_T = Division::where('code', 'AR-T')->firstOrFail()->id;
        $prov_U = Division::where('code', 'AR-U')->firstOrFail()->id;       
        $prov_V = Division::where('code', 'AR-V')->firstOrFail()->id;
        $prov_W = Division::where('code', 'AR-W')->firstOrFail()->id;
        $prov_X = Division::where('code', 'AR-X')->firstOrFail()->id;
        $prov_Y = Division::where('code', 'AR-Y')->firstOrFail()->id;
        $prov_Z = Division::where('code', 'AR-Z')->firstOrFail()->id;

        

        \DB::table('world_cities')->where('country_id', '=', $pais)->delete();
             
        \DB::table('world_cities')->insert(array (
            0 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'PUERTO PARANAY',
                'code' => 3384,
            ),
            1 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'PUERTO RICO',
                'code' => 3334,
            ),
            2 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'EL ALCAZAR',
                'code' => 3384,
            ),
            212 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'GARUHAPE',
                'code' => 3334,
            ),
            3 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'CARAGUATAY',
                'code' => 3386,
            ),
            4 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'GUARAYPO',
                'code' => 3384,
            ),
            5 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'ITA CURUZU',
                'code' => 3384,
            ),
            6 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'MONTECARLO',
                'code' => 3384,
            ),
            7 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'ELDORADO',
                'code' => 3380,
            ),
            8 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_N,
                'name' => 'POSADAS',
                'code' => 3300,
            ),
            9 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_H,
                'name' => 'RESISTENCIA',
                'code' => 3500,
            ),
            10 =>
            array (
                'country_id' => $pais,
                'division_id' => $prov_W,
                'name' => 'CORRIENTES',
                'code' => 3400,
            ),            
            11 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_P,
                'name' => 'FORMOSA',
                'code' => 3600,
            ),
            12 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_A,
                'name' => 'SALTA',
                'code' => 4400,
            ),
            13 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_S,
                'name' => 'SANTA FE',
                'code' => 3000,
            ),
            14 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_S,
                'name' => 'ROSARIO',
                'code' => 2000,
            ),
            15 => 
            array (
                'country_id' => $pais,
                'division_id' => $prov_E,
                'name' => 'PARANA',
                'code' => 3100,
            ),   
        ));                                
    }
}