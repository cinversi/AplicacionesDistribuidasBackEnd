<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediosDePago extends Model
{
    protected $fillable = ['verificado','numero','expiracion','cvc','nombre','codigoPostal','tipo','default','cliente_id'];
    use HasFactory;
}
