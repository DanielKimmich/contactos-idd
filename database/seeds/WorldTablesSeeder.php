<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnector;

class WorldTablesSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection() instanceof SQLiteConnection) {
            DB::statement('PRAGMA FOREIGN_KEYS=0');
        } else if(DB::connection() instanceof MySqlConnection) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        } else if(DB::connection() instanceof PostgresConnector) {
            Schema::disableForeignKeyConstraints();
        } else {
           Schema::disableForeignKeyConstraints();
        }

        $this->call(WorldContinentsTableSeeder::class);
        $this->call(WorldContinentsLocaleTableSeeder::class);
        $this->call(WorldCountriesTableSeeder::class);
        $this->call(WorldCountriesLocaleTableSeeder::class);
        $this->call(WorldDivisionsTableSeeder::class);
        $this->call(WorldDivisionsLocaleTableSeeder::class);
        $this->call(WorldCitiesTableSeeder::class);
        $this->call(WorldCitiesLocaleTableSeeder::class);

        if (DB::connection() instanceof SQLiteConnection) {
            DB::statement('PRAGMA FOREIGN_KEYS=1');
        } else if(DB::connection() instanceof MySqlConnection) {
            //DB::unprepared('ALTER TABLE world_countries AUTO_INCREMENT=249;');    
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else if(DB::connection() instanceof PostgresConnector) {
            DB::statement('ALTER SEQUENCE world_continents_pkey RESTART WITH 8;');
            DB::statement('ALTER SEQUENCE world_continents_locale_pkey RESTART WITH 15;');
            DB::statement('ALTER SEQUENCE world_countries_pkey RESTART WITH 249;');
            DB::statement('ALTER SEQUENCE world_countries_locale_pkey RESTART WITH 495;');
            DB::statement('ALTER SEQUENCE world_divisions_pkey RESTART WITH 123;');
            DB::statement('ALTER SEQUENCE world_divisions_locale_pkey RESTART WITH 243;');
            DB::statement('ALTER SEQUENCE world_cities_pkey RESTART WITH 3800;');
            DB::statement('ALTER SEQUENCE world_cities_locale_pkey RESTART WITH 3758;');
            Schema::disableForeignKeyConstraints();
        } else {
            Schema::disableForeignKeyConstraints();
            DB::statement('ALTER SEQUENCE world_continents_pkey RESTART WITH 8;');
            DB::statement('ALTER SEQUENCE world_continents_locale_pkey RESTART WITH 15;');
            DB::statement('ALTER SEQUENCE world_countries_pkey RESTART WITH 249;');
            DB::statement('ALTER SEQUENCE world_countries_locale_pkey RESTART WITH 495;');
            DB::statement('ALTER SEQUENCE world_divisions_pkey RESTART WITH 123;');
            DB::statement('ALTER SEQUENCE world_divisions_locale_pkey RESTART WITH 243;');
            DB::statement('ALTER SEQUENCE world_cities_pkey RESTART WITH 3800;');
            DB::statement('ALTER SEQUENCE world_cities_locale_pkey RESTART WITH 3758;');
        }
    }


}
