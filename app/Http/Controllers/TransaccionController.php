<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{

    public function index()
    {
        $transacciones = Transaccion::all();

        return response()->json([
            'ok' => true,
            'transacciones' => $transacciones
        ], 200);
    }

    public function deposito(Request $request)
    {

        $monto = $request->monto;
        $clienteId = $request->cliente;

        if($monto > 0){
            $tipo = 'deposito';
        }else{
            $tipo = 'retiro';
        }
        
        DB::beginTransaction();
        
        try {
            $cliente = Cuenta::where('id','=', $clienteId)->lockForUpdate()->first();
            
            $balance = $cliente->saldo + $monto;
            
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
            
            // Cuando haya terminado, Laravel liberará el bloqueo automáticamente al finalizar la transacción.
            DB::commit();
        } catch (\Exception $e) {
            // Manejar cualquier excepción y revertir la transacción si es necesario.
            DB::rollback();
        }

        return response()->json([
            'ok' => true,
            'transaccion' => $transaccion,
            'cliente' => $cliente->nroCuenta
        ], 200);

    }

    public function transferencia()
    {
        $envia = mt_rand(1,5);
        $recibe = mt_rand(1,5);
        $monto = mt_rand(1,5000);

        while($recibe===$envia){
            $recibe = mt_rand(1,5);
            echo($recibe);
        }

        DB::beginTransaction();

        try {
            $clienteEnvia = Cuenta::where('id', '=', $envia)->lockForUpdate()->first();
            $clienteRecibe = Cuenta::where('id', '=', $recibe)->lockForUpdate()->first();


            $clienteEnvia->update(
                [
                    'saldo' => $clienteEnvia->saldo - $monto
                ]
            );

            $clienteRecibe->update(
                [
                    'saldo' => $clienteRecibe->saldo - $monto
                ]
            );

            // Cuando haya terminado, Laravel liberará el bloqueo automáticamente al finalizar la transacción.
            DB::commit();
        } catch (\Exception $e) {
            // Manejar cualquier excepción y revertir la transacción si es necesario.
            DB::rollback();
        }

        return response()->json([
            'ok' => true,
            'envia' => $clienteEnvia->nroCuenta,
            'recibe' => $clienteRecibe->nroCuenta,
            'monto' => $monto
        ], 200);

    }
}
