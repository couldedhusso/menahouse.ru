<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('subscriptions', function(Blueprint $t){
            $t->increments('id');
            $t->integer('user')->unsigned();
            $t->string('plan')->default('free');
            $t->unsignedInteger('price')->nullable();
            $t->unsignedInteger('quantity')->default(1);
            $t->timestamp('trial_ends_at')->nullable();
            $t->timestamp('ends_at')->nullable();
            
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
        Schema::drop('subscriptions');
    }
}
