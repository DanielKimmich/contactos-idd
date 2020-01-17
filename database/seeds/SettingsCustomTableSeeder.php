<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsCustomTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'world_continent',
            'name'        => 'Continente',
            'description' => 'Continente por defecto en paises',
            'value'       => '2',
            'field'       => '{"name":"value","label":"Value","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'           => 'world_country',
            'name'          => 'Pais',
            'description'   => 'Pais por defecto en provincias y ciudades',
            'value'         => '208',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,

        ],
        [
            'key'           => 'world_division',
            'name'          => 'Provincia',
            'description'   => 'Provincia por defecto en ciudades',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
 
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
