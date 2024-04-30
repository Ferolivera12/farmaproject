<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }
}
