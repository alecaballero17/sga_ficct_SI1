<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('carreras', function (Blueprint $table) {
            // Campo de código (abreviación de la carrera)
            if (!Schema::hasColumn('carreras', 'codigo')) {
                $table->string('codigo', 20)->unique();
            }

            // Campo de nombre (nombre completo de la carrera)
            if (!Schema::hasColumn('carreras', 'nombre')) {
                $table->string('nombre', 150)->index();
            }

            // Relación con facultad
            if (!Schema::hasColumn('carreras', 'facultad_id')) {
                // Verifica el nombre real de la tabla de facultades (probablemente sea 'facultads')
                $table->foreignId('facultad_id')
                      ->nullable()
                      ->constrained('facultades') // 👈 usa 'facultades' si así se llama en tu BD
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('carreras', function (Blueprint $table) {
            if (Schema::hasColumn('carreras', 'facultad_id')) {
                $table->dropConstrainedForeignId('facultad_id');
            }
            if (Schema::hasColumn('carreras', 'nombre')) {
                $table->dropColumn('nombre');
            }
            if (Schema::hasColumn('carreras', 'codigo')) {
                $table->dropColumn('codigo');
            }
        });
    }
};
