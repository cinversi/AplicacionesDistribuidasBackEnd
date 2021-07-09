<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duenio extends Model
{
    protected $fillable = ['numeroPais','verificaciónFinanciera','verificaciónJudicial','calificacionRiesgo','persona_id','verificador'];
    use HasFactory;
}
