<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = ['descripcion','responsable_id','subasta_id'];
    use HasFactory;
    public function items()
    {
        return $this->hasMany('App\Models\ItemsCatalogo','catalogo_id');
    }
}
