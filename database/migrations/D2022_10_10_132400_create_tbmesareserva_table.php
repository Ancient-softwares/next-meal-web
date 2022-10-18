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
        Schema::create('tbmesareserva', function (Blueprint $table) {
            $table->increments('idMesaReserva');
            $table->unsignedInteger('idMesa');
            $table->unsignedInteger('idReserva');
            $table->timestamps();

            //Foreign Key
            $table->foreign('idMesa')
                ->references('idMesa')
                ->on('tbmesa');


            $table->foreign('idReserva')
                ->references('idReserva')
                ->on('tbreserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbmesareserva');
    }
};