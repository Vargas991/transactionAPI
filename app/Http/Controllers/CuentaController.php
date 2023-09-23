<?php

namespace App\Http\Controllers;
use App\Models\Cuenta;

use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::all();

        return response()->json([
            'message' => $cuentas,
        ], 200);
    }

    public function recibiendoId(Request $cuenta )
    {

        $id = $cuenta->id;

      
        return response()->json([
            // 'message' => $cuentas,
            'data' => $id
        ], 200);
    }
}
