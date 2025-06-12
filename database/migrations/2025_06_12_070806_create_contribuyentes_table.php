<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contribuyentes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipoDeDocumento', ['CC', 'NIT', 'TI', 'CE']);
            $table->bigInteger('documento')->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100)->nullable();
            $table->string('nombreCompleto', 200);
            $table->string('direccion', 150);
            $table->string('telefono', 40);
            $table->string('celular', 40);
            $table->string('email', 150)->unique();
            $table->string('usuario', 50)->unique();
            $table->timestamp('fechaSistema')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribuyentes');
    }
};
