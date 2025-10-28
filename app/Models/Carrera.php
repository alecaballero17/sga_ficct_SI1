<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carrera';
    public $timestamps = false; // <- importante

    protected $fillable = ['nombre','sigla','estado','facultad_id'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }
}
