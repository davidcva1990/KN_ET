<?php

namespace App\Http\Controllers;

use App\Models\empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresasPosicionesController extends Controller
{
    public function index() {
        $empresas = empresas::orderBy('id', 'desc')->get();
        
        if ($empresas->isEmpty()){
            
            $data = [
                'message' => 'No hay Empresas cargados',
                'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            return response()->json($empresas, 200);
        }
    }
}
