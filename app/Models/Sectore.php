<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectore extends Model
{
    protected $fillable = ['matricula','region','persona_id'];
    use HasFactory;
}
