<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function tarif()
    {
        return $this->hasMany('App\Models\Tarif', 'id_lapangan');
    }
}
