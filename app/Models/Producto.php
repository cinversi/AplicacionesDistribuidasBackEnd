<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['fecha','descripcionCatalogo','descripcionCompleta','revisor_id','duenio_id'];
    use HasFactory;
}
