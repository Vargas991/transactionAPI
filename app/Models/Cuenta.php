<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;


    protected $fillable = ['saldo'];
    
    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class, 'cluster_id', 'id');
    }

}
