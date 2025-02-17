<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function usuarios() {
        return $this->belongsToMany(User::class, 'rolesusuarios','id_usuario', 'id_rol');
    }
}
