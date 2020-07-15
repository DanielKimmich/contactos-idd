<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtrasToContenttype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_types', function (Blueprint $table) {
            $table->string('extras')->nullable()->after('parent_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_types', function (Blueprint $table) {
            $table->dropColumn('extras');
        });
    }
}
