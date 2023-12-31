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
            'ok' => true,
            'cuentas' => $cuentas
        ], 200);
    }
}
