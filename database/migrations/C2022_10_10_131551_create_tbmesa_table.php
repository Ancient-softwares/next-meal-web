<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbmesa', function (Blueprint $table) {
            $table->increments('idMesa');
            $table->integer('quantAcentosMesa');
            $table->integer('statusMesa');
            $table->integer('numMesa');
            $table->unsignedInteger('idRestaurante');
            $table->timestamps();


            //Foreign Key
            $table->foreign('idRestaurante')
                ->references('idRestaurante')
                ->on('tbrestaurante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbmesa');
    }
};