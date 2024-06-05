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
        $rules = [
            'nombre' => 'required|string|min:1|max:255',
            'ubicacion' => 'nullable|string|max:255',
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

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->nombre = $request->nombre;
        $departamento->ubicacion = $request->ubicacion;
        $departamento->save();
        return  $departamento;

        return response()->json([
            'status' => true,
            'message' => 'Departamento actualizado con éxito'
        ], 200);
    }

    public function destroy($id)
    {
        $departamento = Departamento::destroy($id);
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
