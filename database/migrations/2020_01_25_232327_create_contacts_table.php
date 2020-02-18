<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');        
            $table->string('sexo'); 
            $table->string('nationality_id')->nullable(); 
            $table->string('blood_type')->nullable();           
            $table->string('photo_id')->nullable(); 
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('contact_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->string('account_name')->nullable();    
            $table->string('account_type')->nullable();            
            $table->string('aggregation_mode')->nullable();    
            $table->string('deleted')->nullable(); 
            $table->string('source_id')->nullable(); 
            $table->timestamps();

            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('cascade');

         });

        Schema::create('contact_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->string('mimetype');          
            $table->string('data1')->nullable();
            $table->string('data2')->nullable();
            $table->string('data3')->nullable();
            $table->string('data4')->nullable();
            $table->string('data5')->nullable();
            $table->string('data6')->nullable();
            $table->string('data7')->nullable();
            $table->string('data8')->nullable();
            $table->string('data9')->nullable();
            $table->string('data10')->nullable();
            $table->string('data11')->nullable();
            $table->string('data12')->nullable();
            $table->string('data13')->nullable();
            $table->string('data14')->nullable();
            $table->binary('data15')->nullable();
            $table->timestamps();

            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('cascade');
        });

  Schema::create('content_alias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mimetype');        
            $table->string('alias');   
            $table->string('data_column');
            $table->timestamps();
        });

 Schema::create('content_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mimetype');        
            $table->string('type');   
            $table->unsignedInteger('order');
            $table->string('label');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
         Schema::dropIfExists('row_contacts');
          Schema::dropIfExists('data_contacts');
    }
}
