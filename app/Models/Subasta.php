<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    protected $fillable = ['ubicacion','fecha','horaInicio','horaFin','estado','capacidadAsistentes','tieneDeposito','seguridadPropia','categoria','moneda','subastador_id'];
    use HasFactory;
    
    public function catalogo()
    {
        return $this->hasOne('App\Models\Catalogo', 'subasta_id');
    }
}