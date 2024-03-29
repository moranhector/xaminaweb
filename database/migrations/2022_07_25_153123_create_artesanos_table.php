<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtesanosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artesanos', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre');
            $table->string('documento');
            $table->string('cuit')->nullable();
            $table->string('direccion')->nullable();
            $table->string('lugar')->nullable();
            $table->string('departamento')->nullable();
            $table->date('nacimiento_at')->nullable();
            $table->string('sexo')->nullable();
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
        Schema::drop('artesanos');
    }
}
