<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }
    public function salidas()
    {
        return $this->hasMany(Salida::class);
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
