<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['categoria','persona_id','empleado_id','numeroPais_id'];
    use HasFactory;
}
