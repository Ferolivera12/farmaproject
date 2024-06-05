<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicamentoPedido;
use Illuminate\Support\Facades\Validator;

class MedicamentoPedidoController extends Controller
{

    public function index()
    {
        $medicamentoPedido = MedicamentoPedido::all();
        return response()->json($medicamentoPedido);
    }

    public function store(Request $request)
    {
        $rules = [
            'idmedicamento' => 'required | numeric',
            'idpedido' => 'required | numeric',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $medicamentoPedido = new MedicamentoPedido($request->input());
        $medicamentoPedido->save();

        return response()->json([
            'status' => true,
            'message' => 'MedicamentoPedido creado con éxito'
        ], 200);
    }

    public function show($id)
    {
        $medicamentoPedido = MedicamentoPedido::find($id);

        if (!$medicamentoPedido) {
            return response()->json([
                'status' => false,
                'message' => 'MedicamentoPedido no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $medicamentoPedido
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $medicamentoPedido = MedicamentoPedido::findOrFail($id);
        $medicamentoPedido->idmedicamento = $request->idmedicamento;
        $medicamentoPedido->idpedido = $request->idpedido;
        $medicamentoPedido->save();
        return  $medicamentoPedido;

        return response()->json([
            'status' => true,
            'message' => 'MedicamentoPedido actualizado con exito'
        ], 200);
    }

    public function destroy($id)
    {
        $medicamentoPedido = MedicamentoPedido::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'MedicamentoPedido eliminado con exito'
        ], 200);
    }

    public function all()
    {
        $medicamentoPedidos = MedicamentoPedido::all();
        return response()->json($medicamentoPedidos);
    }
}
