<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'tipo', 'order', 'created_at', 'updated_at'];

    
    public function formulario() {
        return $this->belongsToMany(Formulario::class, 'preguntaFormulario', 'id_formulario', 'id_pregunta');
    }
}
