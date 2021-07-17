<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    protected $fillable = ['numeroPostor','participando','cliente_id','subasta_id'];
    use HasFactory;
}
