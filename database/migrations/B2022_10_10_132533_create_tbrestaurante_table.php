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
        Schema::create('tbrestaurante', function (Blueprint $table) {
            $table->increments('idRestaurante');
            $table->string('nomeRestaurante', 300);
            $table->char('cnpjRestaurante', 14);
            $table->char('telRestaurante', 13);
            $table->string('loginRestaurante', 100);
            $table->string('senhaRestaurante', 255);
            $table->string('fotoRestaurante', 255);
            $table->string('emailRestaurante', 100);
            $table->char('cepRestaurante', 9);
            $table->string('ruaRestaurante', 100);
            $table->string('numRestaurante', 5);
            $table->string('bairroRestaurante', 100);
            $table->string('cidadeRestaurante', 100);
            $table->string('estadoRestaurante', 40);
            $table->time('horarioAberturaRestaurante');
            $table->time('horarioFechamentoRestaurante');
            $table->integer('capMaximaRestaurante');
            $table->unsignedInteger('idTipoRestaurante');

            $table->timestamps();

            // Foreign Key
            $table->foreign('idTipoRestaurante')
                ->references('idTipoRestaurante')
                ->on('tbtiporestaurante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbrestaurante');
    }
};
