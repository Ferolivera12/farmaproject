<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use Illuminate\Support\Facades\Validator;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::all();
        return response()->json($salidas);
    }

    public function store(Request $request)
    {
        $this->authorize('crear salida');
        $rules = [
            'fecha_hora' => 'required | dateTime',
            'medicamento' => 'required | string | max:255',
            'cantidad' => 'required | integer',
            'motivo' => 'required | string | in:venta,vencimiento,devolución',
            'id_usuario' => 'required | integer',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $salida = new Salida($request->input());
        $salida->save();

        return response()->json([
            'status' => true,
            'message' => 'Salida creada con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver salida');
        $salida = Salida::find($id);

        if (!$salida) {
            return response()->json([
                'status' => false,
                'message' => 'Salida no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $salida
        ], 200);
    }

    public function update(Request $request, Salida $salida)
    {
        $this->authorize('editar salida');
        $rules = [
            'fecha' => 'date',
            'medicamento' => 'string | max:255',
            'cantidad' => 'integer',
            'motivo' => 'string | in:venta,vencimiento,devolución',
            'id_usuario' => 'integer',
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
        if ($request->has('medicamento')) {
            $data['medicamento'] = $request->input('medicamento');
        }
        if ($request->has('cantidad')) {
            $data['cantidad'] = $request->input('cantidad');
        }
        if ($request->has('motivo')) {
            $data['motivo'] = $request->input('motivo');
        }
        if ($request->has('id_usuario')) {
            $data['id_usuario'] = $request->input('id_usuario');
        }
        $salida->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Salida actualizada con éxito'
        ], 200);
    }

    public function destroy(Salida $salida)
    {
        $this->authorize('eliminar salida');
        $salida->delete();
        return response()->json([
            'status' => true,
            'message' => 'Salida eliminada con éxito'
        ], 200);
    }

    public function all()
    {
        $salidas = Salida::all();
        return response()->json($salidas);
    }
}
