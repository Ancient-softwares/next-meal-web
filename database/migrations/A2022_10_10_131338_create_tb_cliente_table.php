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
        Schema::create('tbcliente', function (Blueprint $table) {
            $table->increments('idCliente');
            $table->string('nomeCliente', 300);
            $table->char('cpfCliente', 11)->unique();
            $table->string('senhaCliente', 255);
            $table->string('fotoCliente');
            $table->string('emailCliente', 100)->unique();
            $table->char('cepCliente', 8)->unique();
            $table->string('telefoneCliente', 11)->unique();
            $table->string('ruaCliente', 100);
            $table->string('numCasa', 5);
            $table->string('bairroCliente', 100);
            $table->string('cidadeCliente', 100);
            $table->string('estadoCliente', 40);
            $table->string('token', 255)->default('---');
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
        Schema::dropIfExists('tbcliente');
    }
};
