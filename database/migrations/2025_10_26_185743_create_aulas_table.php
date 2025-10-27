<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->integer('capacidad')->default(40);
            $table->string('ubicacion')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('aulas');
    }
};
