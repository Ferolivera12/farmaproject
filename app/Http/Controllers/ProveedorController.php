<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $proveedor = new Proveedor([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos', 'Apellido predeterminado'), // Valor predeterminado si no se proporciona
            'telefono' => $request->input('telefono'),
        ]);
        $proveedor->save();

        return response()->json([
            'status' => true,
            'message' => 'Proveedor creado con éxito'
        ], 200);
    }


    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json([
                'status' => false,
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $proveedor
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->apellidos = $request->apellidos;
        $proveedor->telefono = $request->telefono;
        $proveedor->save();
        return $proveedor;
        return response()->json([
            'status' => true,
            'message' => 'Proveedor actualizado con éxito'
        ], 200);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Proveedor eliminado con éxito'
        ], 200);
    }

    public function all()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }
}
