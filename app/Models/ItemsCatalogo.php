<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsCatalogo extends Model
{
    protected $fillable = ['precioBase','comision','subastado','catalogo_id','producto_id'];
    use HasFactory;
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
}
