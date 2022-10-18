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
        Schema::create('tbavaliacao', function (Blueprint $table) {
            $table->increments('idAvaliacao');
            $table->date('dtAvaliacao');
            $table->integer('notaAvaliacao');
            $table->string('descAvaliacao', 255);
            $table->integer('idRestaurante');
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
        Schema::dropIfExists('tbavaliacao');
    }
};