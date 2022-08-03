<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('id');
            $table->string('codigo12');
            $table->integer('tipopieza_id');
            $table->string('npieza');
            $table->string('namepieza');
            $table->string('comprob');
            $table->string('recibo_id');
            $table->string('factura');
            $table->string('factura_id');
            $table->decimal('costo');
            $table->string('recargo');
            $table->integer('artesano_id');
            $table->date('comprado_at');
            $table->date('vendido_at');
            $table->decimal('precio');
            $table->date('precio_at');
            $table->string('foto');
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
        Schema::drop('inventarios');
    }
}
