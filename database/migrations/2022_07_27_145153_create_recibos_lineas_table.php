<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosLineasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_lineas', function (Blueprint $table) {
            $table->id('id');
            $table->integer('recibo_id');
            $table->integer('tipopieza_id');
            $table->integer('cantidad');
            $table->decimal('preciounit');
            $table->decimal('importe');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recibos_lineas');
    }
}
