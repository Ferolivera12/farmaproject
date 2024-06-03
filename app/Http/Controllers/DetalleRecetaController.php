<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleReceta;
use Illuminate\Support\Facades\Validator;

class DetalleRecetaController extends Controller
{
    public function index()
    {
        $detalles = DetalleReceta::all();
        return response()->json($detalles);
    }

    public function store(Request $request)
    {
        $rules = [
            'id_receta' => 'required | integer',
            'id_medicamento' => 'required | integer',
            'cantidad' => 'required | integer',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $detalleReceta = new DetalleReceta($request->input());
        $detalleReceta->save();

        return response()->json([
            'status' => true,
            'message' => 'Detalle de receta creado con éxito'
        ], 200);
    }

    public function show($id)
    {
        $detalleReceta = DetalleReceta::find($id);

        if (!$detalleReceta) {
            return response()->json([
                'status' => false,
                'message' => 'Detalle de receta no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $detalleReceta
        ], 200);
    }

    public function update(Request $request, DetalleReceta $detalleReceta)
    {
        $rules = [
            'id_receta' => 'integer',
            'id_medicamento' => 'integer',
            'cantidad' => 'integer',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = [];
        if ($request->has('id_receta')) {
            $data['id_receta'] = $request->input('id_receta');
        }
        if ($request->has('id_medicamento')) {
            $data['id_medicamento'] = $request->input('id_medicamento');
        }
        if ($request->has('cantidad')) {
            $data['cantidad'] = $request->input('cantidad');
        }
        $detalleReceta->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Detalle de receta actualizado con éxito'
        ], 200);
    }

    public function destroy(DetalleReceta $detalleReceta)
    {
        $detalleReceta->delete();
        return response()->json([
            'status' => true,
            'message' => 'Detalle de receta eliminado con éxito'
        ], 200);
    }

    public function all()
    {
        $detalles = DetalleReceta::all();
        return response()->json($detalles);
    }
}
