<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Facades\DB;
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
        Schema::create('tbhistorico_cliente', function (Blueprint $table) {
            $table->increments('idHistoricoCliente');
            $table->unsignedInteger('idCliente');
            $table->unsignedInteger('idReserva');
            $table->unsignedInteger('idStatusReserva');
            $table->timestamps();

            //Foreign Key

            $table->foreign('idCliente')
                ->references('idCliente')
                ->on('tbcliente');

            $table->foreign('idReserva')
                ->references('idReserva')
                ->on('tbreserva');

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
        Schema::dropIfExists('tbhistorico_cliente');
    }
};
