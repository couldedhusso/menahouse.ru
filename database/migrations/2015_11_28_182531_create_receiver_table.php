<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('receivers', function(Blueprint $t){
          $t->increments('id');
          $t->integer('msgid')->unsigned();
          $t->integer('from')->unsigned();
          $t->timestamps('last_read');
          $t->softDeletes();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('receivers');
    }
}
