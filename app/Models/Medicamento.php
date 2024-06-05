<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    // Relación uno a muchos: Un medicamento tiene muchas categorías
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    protected $fillable = [
        'nombre',
        'descripcion',
        'fechavencimiento',
        'categoria_id',
        'precio',
        'laboratorio',
    ];
}
