<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(SettingsCustomTableSeeder::class);
        $this->call(WorldTablesSeeder::class);
        $this->call(ArgentinaDivisionsTableSeeder::class);
        $this->call(ArgentinaCitiesTableSeeder::class);
        $this->call(ContactContentAlias::class);
        $this->call(ContactContentTypes::class);

    }
}
