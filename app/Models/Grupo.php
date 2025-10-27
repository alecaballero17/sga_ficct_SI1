<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $fillable = ['codigo','materia_id','aula_id','cupos'];

    public function materia() { return $this->belongsTo(Materia::class); }
    public function aula()    { return $this->belongsTo(Aula::class); }
}
