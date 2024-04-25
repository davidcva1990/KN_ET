<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductosController extends Controller
{
    public function index() {
        $productos = Productos::orderBy('usoFrecuente', 'desc')->get();
        
        if ($productos->isEmpty()){
            
            $data = [
                'message' => 'No hay productos cargados',
                'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            return response()->json($productos, 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:Productos|max:255',
            'usoFrecuente' => 'required|integer'

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la Validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto = Productos::create([
             'nombre' => $request->nombre,
             'usoFrecuente' =>$request->usoFrecuente

        ]);

        if (!$producto) {
            $data = [
                'message' => 'Error al crear producto',
                'status' => '500'
            ];

            return response()->json($data, 500);
        }

        $data = [
            'producto' => $producto,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function show($id) {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto No encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($producto, 200);
    }

    public function update(Request $request, $id) {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto No encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:Productos|max:255',
            'usoFrecuente' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la Validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto->nombre = $request->nombre;
        $producto->usoFrecuente = $request->usoFrecuente;
        
        $producto->save();

        $data = [
            'message' => 'Producto Actualizado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function destroy($id) {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto No encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'message' => 'Producto Eliminado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id) {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto No encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'unique:Productos|max:255',
            'usoFrecuente' => 'integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la Validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $producto->nombre = $request->nombre;
        }
        
        if ($request->has('usoFrecuente')) {
            $producto->usoFrecuente = $request->usoFrecuente;
        }

        $producto->save();

        $data = [
            'message' => 'Se actualizo el producto',
            'producto' => $producto,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
