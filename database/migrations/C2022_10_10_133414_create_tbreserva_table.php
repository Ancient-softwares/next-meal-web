<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbreserva', function (Blueprint $table) {
            $table->increments('idReserva');
            $table->date('dataReserva');
            $table->time('horaReserva');
            $table->integer('numPessoas');
            $table->unsignedInteger('idCliente');
            $table->unsignedInteger('idRestaurante');
            $table->unsignedInteger('idStatusReserva');
            $table->timestamps();

            //Foreign Key

            $table->foreign('idCliente')
                ->references('idCliente')
                ->on('tbcliente');


            $table->foreign('idRestaurante')
                ->references('idRestaurante')
                ->on('tbrestaurante');


            $table->foreign('idStatusReserva')
                ->references('idStatusReserva')
                ->on('tbstatusreserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbreserva');
    }
};
