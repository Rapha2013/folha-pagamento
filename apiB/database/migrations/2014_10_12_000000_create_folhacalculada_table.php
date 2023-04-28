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
        Schema::create('folhacalculada', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('ano');
            $table->integer('horas');
            $table->double('valor');
            $table->double('bruto');
            $table->double('irrf');
            $table->double('inss');
            $table->double('fgts');
            $table->double('liquido');
            $table->integer('id_funcionario');
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
        Schema::dropIfExists('folhacalculada');
    }
};
