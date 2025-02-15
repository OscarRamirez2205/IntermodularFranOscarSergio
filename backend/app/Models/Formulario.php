<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'definicion', 'tipo',  'id_token', 'created_at', 'updated_at'];

    
    public function usuarios() {
        return $this->hasOne(Usuario::class);
    }
    public function preguntas() {   
        return $this->belongsToMany(Pregunta::class, 'preguntaFormulario', 'id_formulario', 'id_pregunta');
    }
    public function centros() {
        return $this->belongsToMany(Centro::class, 'centro_formulario', 'id_centro', 'id_formulario');
    }
    public function token(){
        return $this->hasOne(Token::class);
    }
}
