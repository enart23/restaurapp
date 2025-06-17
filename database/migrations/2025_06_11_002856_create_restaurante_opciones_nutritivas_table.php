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
        Schema::create('restaurante_opciones_nutritivas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurante_id')
                ->constrained('restaurantes')->onDelete('cascade');
            $table->foreignId('opcion_nutritiva_id')
                ->constrained('opciones_nutritivas')->onDelete('cascade');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurante_opciones_nutritivas');
    }
};
