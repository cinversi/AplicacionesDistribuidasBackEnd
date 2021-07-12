<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['documento','nombre','direccion'];
    use HasFactory;

    public function UserPersona()
    {
        return $this->hasOne('App\Models\User');
    }
}
