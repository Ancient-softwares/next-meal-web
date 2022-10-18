<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbtiporestaurante', function (Blueprint $table) {
            $table->increments('idTipoRestaurante');
            $table->string('tipoRestaurante', 20);
            $table->timestamps();

            
        });
        DB::table('tbtiporestaurante')->insert(
            array(
                ['tipoRestaurante' => 'Bistrô'],
                ['tipoRestaurante' => 'Fast food'],
                ['tipoRestaurante' => 'buffet'],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbtiporestaurante');
    }
};