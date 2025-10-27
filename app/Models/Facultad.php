<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultades'; // nombre real de la tabla en la BD

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Una facultad puede tener muchas carreras
     */
    public function carreras()
    {
        return $this->hasMany(Carrera::class);
    }
}
