<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicamentoDepartamento;
use Illuminate\Support\Facades\Validator;

class MedicamentoDepartamentoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el iddepartamento de la solicitud
        $idDepartamento = $request->input('iddepartamento');

        // Filtrar los medicamentos por el iddepartamento
        $medicamentoDepartamentos = MedicamentoDepartamento::where('iddepartamento', $idDepartamento)->get();

        return response()->json($medicamentoDepartamentos);
    }

    public function store(Request $request)
    {
        $rules = [
            'idmedicamento' => 'required | numeric',
            'iddepartamento' => 'required | numeric',
            'cantidad' => 'required | numeric',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $medicamentoDepartamento = new MedicamentoDepartamento($request->input());
        $medicamentoDepartamento->save();

        return response()->json([
            'status' => true,
            'message' => 'Relación MedicamentoDepartamento creada con éxito'
        ], 200);
    }

    public function show($id)
    {
        $medicamentoDepartamento = MedicamentoDepartamento::find($id);

        if (!$medicamentoDepartamento) {
            return response()->json([
                'status' => false,
                'message' => 'Relación MedicamentoDepartamento no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $medicamentoDepartamento
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $medicamentoDepartamento = MedicamentoDepartamento::findOrFail($id);
        $medicamentoDepartamento->idmedicamento = $request->idmedicamento;
        $medicamentoDepartamento->iddepartamento = $request->iddepartamento;
        $medicamentoDepartamento->cantidad = $request->cantidad;

        $medicamentoDepartamento->save();
        return response()->json([
            'status' => true,
            'message' => 'Relación MedicamentoDepartamento actualizada con éxito'
        ], 200);
    }

    public function destroy($id)
    {
        $medicamentoDepartamento = MedicamentoDepartamento::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Relación MedicamentoDepartamento eliminada con éxito'
        ], 200);
    }

    public function all()
    {
        $medicamentoDepartamentos = MedicamentoDepartamento::all();
        return response()->json($medicamentoDepartamentos);
    }
}
