<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendicionesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendiciones', function (Blueprint $table) {
            $table->id('id');
            $table->integer('cheque_id');
            $table->integer('inventario_id');
            $table->integer('recibo_id');
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
        Schema::drop('rendiciones');
    }
}
