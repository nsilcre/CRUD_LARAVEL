<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->string('matricula', 10)->primary();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->date('fecha_fabricacion');
            $table->boolean('disponible')->default(true);
            $table->enum('combustible', ['hibrido', 'electrico', 'gasolina', 'diesel']);
            $table->decimal('precio', 10, 2)->nullable();
            $table->integer('kilometraje')->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index('marca');
            $table->index('disponible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
