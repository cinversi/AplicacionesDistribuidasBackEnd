<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediosDePago extends Model
{
    protected $fillable = ['verificado','cuentabancaria','numero','expiracion','cvc','nombre','codigoPostal','tipo','cliente_id'];
    use HasFactory;
}
