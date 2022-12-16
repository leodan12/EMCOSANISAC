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
        Schema::create('detalleventas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->double('preciounidad');
            $table->double('descuento');
            $table->double('preciototal');
            $table->boolean('estado');
            $table->foreignId('inventario_id');
            $table->foreignId('venta_id');
            $table->timestamps();
            $table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->foreign('venta_id')->references('id')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleventas');
    }
};
