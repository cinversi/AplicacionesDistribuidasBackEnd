<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    protected $fillable = ['nombre','nombreCorto','capital','nacionalidad','idiomas'];
    use HasFactory;
}
