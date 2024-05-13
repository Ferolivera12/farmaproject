<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    public function recetas()
    {
        return $this->hasMany(RecetaMedica::class);
    }
    public function usuarios()
    {
        return $this->belongsTo(User::class);
    }
}
