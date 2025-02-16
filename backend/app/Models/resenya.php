<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class resenya extends Model
{
    use HasFactory;
    protected $fillable = ['fecha_resena', 'valoracion','id_pregunta_formulario' ,'created_at', 'updated_at'];

    
    public function pregunta_formulario() {
        return $this->belongsToMany(PreguntaFormulario::class);
    }

}
