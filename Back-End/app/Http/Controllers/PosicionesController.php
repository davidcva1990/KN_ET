<?php

namespace App\Http\Controllers;

use App\Models\posiciones;
use App\Models\empresas;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PosicionesController extends Controller
{
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'idEmpresa' => 'required|exists:empresas,id',
            'idProducto' => 'required|exists:productos,id',
            //'fechaEntregaInicio' => 'required|date',
            'fechaEntregaInicio' => 'required|date|after_or_equal:'. date('Y-m-d'),
            'moneda' => 'required|string',
            'precio' => 'required|integer|min:0'

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la Validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $posicion = posiciones::create([
             'idEmpresa' => $request->idEmpresa,
             'idProducto' =>$request->idProducto,
             'fechaEntregaInicio' =>$request->fechaEntregaInicio,
             'moneda' =>$request->moneda,
             'precio' =>$request->precio

        ]);

        if (!$posicion) {
            $data = [
                'message' => 'Error al crear una posicion',
                'status' => '500'
            ];

            return response()->json($data, 500);
        }

        $data = [
            'posicion' => $posicion,
            'status' => 201
        ];

        return response()->json($data, 201);

    }


    public function index() {
        $posiciones = posiciones::all();

        if($posiciones->isEmpty()) {
            $data = [
                'message' => 'No hay Posiciones cargadas',
                'status' => 404
            ];

            return response()->json($data, 200);
        } 

        return response()->json($posiciones, 200);
    }


    public function frecuently() {
        $posiciones = posiciones::join('Productos', 'posiciones.idProducto', '=', 'Productos.id')->orderBy('Productos.usoFrecuente', 'desc')->get();

        if($posiciones->isEmpty()) {
            $data = [
                'message' => 'No hay Posiciones cargadas',
                'status' => 404
            ];

            return response()->json($data, 200);
        } 

        return response()->json($posiciones, 200);
    }

    public function union() {
        $posiciones = posiciones::join('Productos', 'posiciones.idProducto', '=', 'Productos.id')
                                ->join('empresas', 'posiciones.idEmpresa', '=', 'empresas.id')
                                ->orderBy('posiciones.id', 'desc')
                                ->get();

        if($posiciones->isEmpty()) {
            $data = [
                'message' => 'No hay Posiciones cargadas',
                'status' => 404
            ];

            return response()->json($data, 200);
        } 

        return response()->json($posiciones, 200);
    }

}
