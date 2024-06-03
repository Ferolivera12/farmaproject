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
        $this->authorize('crear proveedor');
        $rules = [
            'nombre' => 'required | string | max:255',
            'apellidos' => 'required | string | max:255',
            'telefono' => 'required | string | max:15',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $proveedor = new Proveedor($request->input());
        $proveedor->save();

        return response()->json([
            'status' => true,
            'message' => 'Proveedor creado con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver proveedor');
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

    public function update(Request $request, Proveedor $proveedor)
    {
        $this->authorize('editar proveedor');
        $rules = [
            'nombre' => 'string | max:255',
            'apellidos' => 'string | max:255',
            'telefono' => 'string | max:15',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = [];
        if ($request->has('nombre')) {
            $data['nombre'] = $request->input('nombre');
        }
        if ($request->has('apellidos')) {
            $data['apellidos'] = $request->input('apellidos');
        }
        if ($request->has('telefono')) {
            $data['telefono'] = $request->input('telefono');
        }
        $proveedor->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Proveedor actualizado con éxito'
        ], 200);
    }

    public function destroy(Proveedor $proveedor)
    {
        $this->authorize('eliminar proveedor');
        $proveedor->delete();
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
