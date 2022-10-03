<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipopiezasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopiezas', function (Blueprint $table) {
            $table->id('id');
            $table->string('descrip');
            $table->string('tecnica');
            $table->integer('rubro_id')->unsigned();
            $table->decimal('precio');
            $table->string('insumo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rubro_id')->references('id')->on('rubros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipopiezas');
    }
}
