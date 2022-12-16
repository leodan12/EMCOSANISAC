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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->string('descripcion');
            $table->double('costocompra');
            $table->string('estadocompra');
            $table->boolean('estado');
            $table->foreignId('proveedor_id');
            $table->foreignId('usuario_id');
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
