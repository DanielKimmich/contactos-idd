<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignToWorld extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('world_countries', function(Blueprint $table)
        {
            $table->dropForeign('world_countries_ibfk_1');
            $table->foreign('continent_id', 'world_countries_ibfk_1')
                ->references('id')
                ->on('world_continents')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT')
                ->change();
        });

        Schema::table('world_divisions', function(Blueprint $table)
        {
            $table->dropForeign('world_divisions_ibfk_1');
            $table->foreign('country_id', 'world_divisions_ibfk_1')
                ->references('id')
                ->on('world_countries')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT')
                ->change();
        });

        Schema::table('world_cities', function(Blueprint $table)
        {
            $table->dropForeign('world_cities_ibfk_1');
            $table->foreign('country_id', 'world_cities_ibfk_1')
                ->references('id')
                ->on('world_countries')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT')
                ->change();

            $table->dropForeign('world_cities_ibfk_2');
            $table->foreign('division_id', 'world_cities_ibfk_2')
                ->references('id')
                ->on('world_divisions')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('world_countries', function(Blueprint $table)
        {
            $table->dropForeign('world_countries_ibfk_1');
            $table->foreign('continent_id', 'world_countries_ibfk_1')
                ->references('id')
                ->on('world_continents')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE')
                ->change();
        });

        Schema::table('world_divisions', function(Blueprint $table)
        {
            $table->dropForeign('world_divisions_ibfk_1');
            $table->foreign('country_id', 'world_divisions_ibfk_1')
                ->references('id')
                ->on('world_countries')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE')
                ->change();
        });

        Schema::table('world_cities', function(Blueprint $table)
        {
            $table->dropForeign('world_cities_ibfk_1');
            $table->foreign('country_id', 'world_cities_ibfk_1')
                ->references('id')
                ->on('world_countries')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE')
                ->change();

            $table->dropForeign('world_cities_ibfk_2');
            $table->foreign('division_id', 'world_cities_ibfk_2')
                ->references('id')
                ->on('world_divisions')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE')
                ->change();
        });
    }
}
