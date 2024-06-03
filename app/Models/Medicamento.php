<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    // Relación uno a muchos: Un medicamento tiene muchas categorías
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
    protected $fillable = [
        'nombre',
        'descripcion',
        'fechavencimiento',
        'categoria',
        'precio',
        'laboratorio',
    ];
}
