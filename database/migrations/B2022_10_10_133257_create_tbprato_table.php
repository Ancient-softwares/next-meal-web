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
        Schema::create('tbprato', function (Blueprint $table) {
            $table->increments('idPrato');
            $table->string('nomePrato', 60);
            $table->decimal('valorPrato', 6, 2);
            $table->string('ingredientesPrato', 100);
            $table->string('fotoPrato', 255);
            $table->unsignedInteger('idTipoPrato');
            $table->unsignedInteger('idRestaurante');

            $table->timestamps();

            // Foreign key
            $table->foreign('idTipoPrato')->references('idTipoPrato')->on('tbtipoprato');
            $table->foreign('idRestaurante')->references('idRestaurante')->on('tbrestaurante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbprato');
    }
};