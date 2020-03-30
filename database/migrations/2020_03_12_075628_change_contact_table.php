<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla de Contactos
        Schema::table('contacts', function (Blueprint $table) {
           // $table->unsignedInteger('nationality_id')->charset('utf8')->collate('utf8_bin')->nullable()->change();
          //  $table->unsignedInteger('nationality_id')->nullable()->charset('')->collate('')->change();
         //   $table->renameColumn('sexo', 'sex_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
