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
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->string('precio')->default(0);
            $table->integer('cantidad')->default(0);
            $table->string('marca', 50)->nullable();
            $table->string('modelo', 50)->nullable();

            //nuevos campos
            $table->integer('peso_teorico')->default(0);
            $table->integer('peso_real')->default(0);
            $table->foreignId('bloque_id')->constrained('bloques')->onDelete('cascade');

            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade');
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
