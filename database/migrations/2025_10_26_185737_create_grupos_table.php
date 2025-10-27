<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10);
            $table->foreignId('materia_id')->constrained('materias')->cascadeOnDelete();
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->nullOnDelete();
            $table->integer('cupos')->default(30);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('grupos');
    }
};
