<?php

// En app/Models/Alumno.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alumno extends Model
{
    use HasFactory;

    //Atributos de la base de datos
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'fecha_nacimiento',
        'nota_media',
        'experiencia',
        'formacion',
        'habilidades',
        'fotografia',
    ];
    
    //Se calcula la edad
    public function getEdadAttribute(): int {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }
}


