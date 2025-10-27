<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'aulas';
    protected $fillable = ['codigo','capacidad','ubicacion'];

    public function grupos() { return $this->hasMany(Grupo::class); }
}
