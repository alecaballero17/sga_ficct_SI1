<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultad';
    public $timestamps = false; // <- tus tablas no tienen created_at/updated_at

    protected $fillable = ['nombre','sigla','estado'];

    public function carreras()
    {
        return $this->hasMany(Carrera::class, 'facultad_id');
    }
}
