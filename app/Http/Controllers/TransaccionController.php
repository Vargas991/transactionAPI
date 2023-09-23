<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Transaccion;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{

    public function index()
    {
        $transacciones = Transaccion::all();

        return response()->json([
            'ok' => 'ok',
            'trans' => $transacciones
        ], 200);
    }

    public function deposito(Request $request)
    {

        $monto = $request->monto;
        $clienteId = $request->cliente;

        $transaccionLast = Transaccion::all()->last();
        
        if($monto > 0){
            $tipo = 'deposito';
        }else{
            $tipo = 'retiro';
        }
        $cliente = Cuenta::findOrfail($clienteId);

        if ($transaccionLast) {
            $balance = $cliente->saldo + $monto;
        } else {
            $balance = $monto ;
        }

        $transaccion = Transaccion::create([
            'tipo' => $tipo,
            'monto' => $monto,
            'balance' => $balance,
            'cuenta_id' => $clienteId
        ]);

        $cliente->update([
            'saldo' => $cliente->saldo + $monto
            ]
        );


        return response()->json([
            'ok' => 'ok',
            'trans' => $transaccion,
            'cliente' => $cliente
        ], 200);

    }
}
