<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistenciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
            $table->id('id');
            $table->integer('inventario_id');
            $table->string('tipodoc');
            $table->string('documento');
            $table->integer('deposito_id');
            $table->string('tiposalida');
            $table->string('documento_sal');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('user_name');
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
        Schema::drop('existencias');
    }
}
