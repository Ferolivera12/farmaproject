<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();
        return response()->json($entradas);
    }

    public function store(Request $request)
    {
        $rules = [
            'fecha_hora' => 'required | dateTime',
            'id_pedido' => 'required | integer',
            'medicamento' => 'required | string | max:255',
            'cantidad' => 'required | integer',
            'lote' => 'required | string | max:255',
            'fecha_vencimiento' => 'required | date',
            'id_usuario' => 'required | integer',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $entrada = new Entrada($request->input());
        $entrada->save();

        return response()->json([
            'status' => true,
            'message' => 'Entrada creada con éxito'
        ], 200);
    }

    public function show($id)
    {
        $entrada = Entrada::find($id);

        if (!$entrada) {
            return response()->json([
                'status' => false,
                'message' => 'Entrada no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $entrada
        ], 200);
    }

    public function update(Request $request, Entrada $entrada)
    {
        $rules = [
            'fecha' => 'date',
            'id_pedido' => 'integer',
            'medicamento' => 'string | max:255',
            'cantidad' => 'integer',
            'lote' => 'string | max:255',
            'fecha_vencimiento' => 'date',
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
        if ($request->has('id_pedido')) {
            $data['id_pedido'] = $request->input('id_pedido');
        }
        if ($request->has('medicamento')) {
            $data['medicamento'] = $request->input('medicamento');
        }
        if ($request->has('cantidad')) {
            $data['cantidad'] = $request->input('cantidad');
        }
        if ($request->has('lote')) {
            $data['lote'] = $request->input('lote');
        }
        if ($request->has('fecha_vencimiento')) {
            $data['fecha_vencimiento'] = $request->input('fecha_vencimiento');
        }
        if ($request->has('id_usuario')) {
            $data['id_usuario'] = $request->input('id_usuario');
        }
        $entrada->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Entrada actualizada con éxito'
        ], 200);
    }

    public function destroy(Entrada $entrada)
    {
        $entrada->delete();
        return response()->json([
            'status' => true,
            'message' => 'Entrada eliminada con éxito'
        ], 200);
    }

    public function all()
    {
        $entradas = Entrada::all();
        return response()->json($entradas);
    }
}
