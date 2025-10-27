<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('ci', 20)->unique();
            $table->string('nombre', 120);
            $table->string('email', 120)->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('categoria', 50)->nullable(); // Auxiliar, Asistente, etc.
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('docentes');
    }
};
