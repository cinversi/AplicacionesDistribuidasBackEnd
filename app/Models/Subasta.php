<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    use HasFactory;
    
    public function catalogo()
    {
        return $this->hasOne('App\Models\Catalogo', 'subasta_id');
    }
}