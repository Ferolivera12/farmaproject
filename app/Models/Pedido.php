<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
