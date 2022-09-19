<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaclineasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faclineas', function (Blueprint $table) {
            $table->id('id');
            $table->integer('factura_id');
            $table->integer('inventario_id');
            $table->integer('cantidad');
            $table->decimal('preciounit');
            $table->decimal('importe');
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
        Schema::drop('faclineas');
    }
}
