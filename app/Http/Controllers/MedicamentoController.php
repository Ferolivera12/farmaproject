<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Validator;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::all();
        return response()->json($medicamentos);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required | string | max:255',
            'descripcion' => 'required | string | max:255',
            'fechavencimiento' => 'required | date',
            'categoria' => 'required | string | max:255',
            'precio' => 'required | numeric',
            'laboratorio' => 'required | string | max:255',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $medicamento = new Medicamento($request->input());
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
        $medicamento = Medicamento::findOrFail($request->id);
        $medicamento->nombre = $request->nombre;
        $medicamento->descripcion = $request->descripcion;
        $medicamento->fechavencimiento = $request->fechavencimiento;
        $medicamento->categoria = $request->categoria;
        $medicamento->precio = $request->precio;
        $medicamento->laboratorio = $request->laboratorio;

        $medicamento->save();
        return  $medicamento;
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
