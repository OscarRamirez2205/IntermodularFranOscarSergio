<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Token extends Model
{
    use HasFactory;
    protected $fillable = ['token'];

    public function createToken($prefix = '')
    {
        // Genera un token único de 32 caracteres con un prefijo opcional
        $uniqueToken = $prefix . '_' . Str::random(32);
        
        // Verifica que el token no exista ya en la base de datos
        while (self::where('token', $uniqueToken)->exists()) {
            $uniqueToken = $prefix . '_' . Str::random(32);
        }
        
        return $uniqueToken;
    }

    public function formulario() {
        return $this->hasOne(Formulario::class, 'token', 'id');
    }

}
