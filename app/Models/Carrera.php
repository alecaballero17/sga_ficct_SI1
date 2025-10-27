<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    protected $fillable = [
        'nombre',
        'codigo',
        'facultad_id',
    ];

    /**
     * Una carrera pertenece a una facultad
     */
    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    /**
     * Una carrera tiene muchas materias
     */
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
}
