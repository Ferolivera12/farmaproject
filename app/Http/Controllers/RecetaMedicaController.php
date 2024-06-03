<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecetaMedica;
use Illuminate\Support\Facades\Validator;

class RecetaMedicaController extends Controller
{
    public function index()
    {
        $recetas = RecetaMedica::all();
        return response()->json($recetas);
    }

    public function store(Request $request)
    {
        $this->authorize('crear receta');
        $rules = [
            'fecha' => 'required | date',
            'paciente' => 'required | string | max:255',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $receta = new RecetaMedica($request->input());
        $receta->save();

        return response()->json([
            'status' => true,
            'message' => 'Receta médica creada con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver receta');
        $receta = RecetaMedica::find($id);

        if (!$receta) {
            return response()->json([
                'status' => false,
                'message' => 'Receta médica no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $receta
        ], 200);
    }

    public function update(Request $request, RecetaMedica $receta)
    {
        $this->authorize('editar receta');
        $rules = [
            'fecha' => 'date',
            'paciente' => 'string | max:255',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = [];
        if ($request->has('fecha')) {
            $data['fecha'] = $request->input('fecha');
        }
        if ($request->has('paciente')) {
            $data['paciente'] = $request->input('paciente');
        }
        $receta->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Receta médica actualizada con éxito'
        ], 200);
    }

    public function destroy(RecetaMedica $receta)
    {
        $this->authorize('eliminar receta');
        $receta->delete();
        return response()->json([
            'status' => true,
            'message' => 'Receta médica eliminada con éxito'
        ], 200);
    }

    public function all()
    {
        $recetas = RecetaMedica::all();
        return response()->json($recetas);
    }
}
