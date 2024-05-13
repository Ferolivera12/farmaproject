<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico; // Reemplaza con la ruta de tu modelo Medico si es diferente
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();
        return response()->json($medicos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'cédula' => 'requerido | string | min:8 | max:10', // Ajusta las reglas de validación según sea necesario
            'nombre' => 'requerido | string | min:3 | max:50',
            'área' => 'requerido | string | min:3 | max:50',
            'id_usuario' => 'requerido | entero', // Ajusta las reglas de validación según sea necesario
        ];

        $validador = Validator::make($request->input(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validador->errors()->all()
            ], 400);
        }

        $medico = Medico::create($request->input());

        return response()->json([
            'estado' => true,
            'mensaje' => 'Médico creado exitosamente',
        ], 200);
    }

    public function show(int $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Médico no encontrado'
            ], 404);
        }

        return response()->json([
            'estado' => true,
            'datos' => $medico
        ], 200);
    }

    public function update(Request $request, Medico $medico)
    {
        $reglas = [
            'cédula' => 'nullable | string | min:8 | max:10', // Ajusta las reglas de validación según sea necesario
            'nombre' => 'nullable | string | min:3 | max:50',
            'área' => 'nullable | string | min:3 | max:50',
            'id_usuario' => 'nullable | entero', // Ajusta las reglas de validación según sea necesario
        ];

        $validador = Validator::make($request->input(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validador->errors()->all()
            ], 400);
        }

        $medico->update($request->input());

        return response()->json([
            'estado' => true,
            'mensaje' => 'Médico actualizado exitosamente'
        ], 200);
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();

        return response()->json([
            'estado' => true,
            'mensaje' => 'Médico eliminado exitosamente'
        ], 200);
    }
}
