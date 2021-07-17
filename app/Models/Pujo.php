<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pujo extends Model
{
    protected $fillable = ['asistente_id','item_id'];
    use HasFactory;
}
