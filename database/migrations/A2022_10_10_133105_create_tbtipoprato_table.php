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
        Schema::create('tbtipoprato', function (Blueprint $table) {
            $table->increments('idTipoPrato');
            $table->string('tipoPrato', 20);
            $table->timestamps();
        });

        DB::table('tbtipoprato')->insert(
            array(
                ['tipoPrato' => 'FastFood'],
                ['tipoPrato' => ''],
                ['tipoPrato' => 'buffet'],
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
        Schema::dropIfExists('tbtipoprato');
    }
};