<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    // Relación muchos a uno: Muchas categorías pertenecen a un medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
