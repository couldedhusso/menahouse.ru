<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('usermessages', function(Blueprint $t){
          $t->increments('id');
          $t->integer('fromid')->unsigned();
          $t->integer('toid')->unsigned();
          $t->text('body');
          $t->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('usermessages');
    }
}
