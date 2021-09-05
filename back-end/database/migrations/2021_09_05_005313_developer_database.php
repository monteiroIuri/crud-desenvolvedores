<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeveloperDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer', function(Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('nome', 220);
            $table->char('sexo', 1);
            $table->integer('idade');
            $table->string('hobby', 140);
            $table->date('datanascimento');
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
        Schema::dropIfExists('developer');
    }
}
