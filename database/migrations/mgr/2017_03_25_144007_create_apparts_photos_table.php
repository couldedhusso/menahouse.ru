<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppartsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appart_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obyavlenie_id')->unsigned();
            $table->foreign('obyavlenie_id')->references('id')
                                            ->on('obivlenie')->onDelete('cascade');
            $table->string('path');
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
        Schema::drop('appart_photos');
    }
}
