<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCanUselToTableObivlenie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obivlenie', function(Blueprint $t){
           $t->integer('san_usel')->unsigned();;
        });
    }

}
