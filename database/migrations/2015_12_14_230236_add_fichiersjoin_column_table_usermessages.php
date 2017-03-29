<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFichiersjoinColumnTableUsermessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usermessages', function(Blueprint $t){
           $t->boolean('fichiers_joints')->default(false);
        });
    }
}
