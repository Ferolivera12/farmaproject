<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Validator;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::with('categoria')->get();
        return response()->json($medicamentos);
    }


    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'fechavencimiento' => 'required|date',
            'categoria_id' => 'required|numeric',
            'precio' => 'required|numeric',
            'laboratorio' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $medicamento = new Medicamento($request->all());
        $medicamento->save();

        return response()->json([
            'status' => true,
            'message' => 'Medicamento creado con éxito'
        ], 200);
    }



    public function show($id)
    {
        $medicamento = Medicamento::find($id);

        if (!$medicamento) {
            return response()->json([
                'status' => false,
                'message' => 'Medicamento no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $medicamento
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = $request->nombre;
        $medicamento->descripcion = $request->descripcion;
        $medicamento->fechavencimiento = $request->fechavencimiento;
        $medicamento->categoria_id = $request->categoria_id;
        $medicamento->precio = $request->precio;
        $medicamento->laboratorio = $request->laboratorio;

        $medicamento->save();

        return response()->json([
            'status' => true,
            'message' => 'Medicamento actualizado con éxito',
            'data' => $medicamento
        ], 200);
    }

    public function destroy($id)
    {
        $medicamento = Medicamento::destroy($id);
        return  $medicamento;
    }

    public function all()
    {
        $medicamentos = Medicamento::all();
        return response()->json($medicamentos);
    }
}
