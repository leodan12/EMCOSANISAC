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
        Schema::create('detalecompras', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->string('unidadmedida');
            $table->double('preciounidad');
            $table->double('preciototal');
            $table->boolean('estado');
            $table->foreignId('inventario_id');
            $table->foreignId('compra_id');
            $table->timestamps();
            $table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->foreign('compra_id')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalecompras');
    }
};
