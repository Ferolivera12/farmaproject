<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos);
    }

    public function store(Request $request)
    {
        $this->authorize('crear departamento');
        $rules = [
            'nombre' => 'required | string | min:1 | max:255',
            'ubicacion' => 'nullable | string | max:255',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $departamento = new Departamento($request->input());
        $departamento->save();

        return response()->json([
            'status' => true,
            'message' => 'Departamento creado con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver departamento');
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'status' => false,
                'message' => 'Departamento no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $departamento
        ], 200);
    }

    public function update(Request $request, Departamento $departamento)
    {
        $this->authorize('editar departamento');
        $rules = [
            'nombre' => 'string | min:1 | max:255',
            'ubicacion' => 'nullable | string | max:255',
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
        if ($request->has('ubicacion')) {
            $data['ubicacion'] = $request->input('ubicacion');
        }
        $departamento->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Departamento actualizado con éxito'
        ], 200);
    }

    public function destroy(Departamento $departamento)
    {
        $this->authorize('eliminar departamento');
        $departamento->delete();
        return response()->json([
            'status' => true,
            'message' => 'Departamento eliminado con éxito'
        ], 200);
    }

    public function all()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos);
    }
}
