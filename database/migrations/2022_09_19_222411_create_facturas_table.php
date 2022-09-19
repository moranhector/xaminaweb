<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id');
            $table->string('formulario');
            $table->string('ptovta');
            $table->string('tipo');
            $table->date('fecha');
            $table->integer('cliente_id');
            $table->decimal('total');
            $table->string('ivacond');
            $table->string('domicilio');
            $table->string('telefono');
            $table->string('email');
            $table->string('tipodoc');
            $table->string('documento');
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
        Schema::drop('facturas');
    }
}
