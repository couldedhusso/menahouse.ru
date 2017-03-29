<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivers', function(Blueprint $t){
            $t->boolean('spam')->default(false) ;
            $t->boolean('readed')->default(false) ;
            $t->boolean('deleted')->default(false) ;
        });
    }
}
