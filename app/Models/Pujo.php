<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pujo extends Model
{
    protected $fillable = ['importe','comision','subasta_id','duenio_id','producto_id','cliente_id'];
    use HasFactory;
}
