<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = ['monto',
                            'tipo',
                            'balance',
                            'cuenta_id'
                        ];

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'cuenta_id', 'id');
    }


}
