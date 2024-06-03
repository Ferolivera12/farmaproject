<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
    }

    public function store(Request $request)
    {
        $this->authorize('crear pedido');
        $rules = [
            'fecha_hora' => 'required | dateTime',
            'cantidad' => 'required | integer',
            'precio_unitario' => 'required | numeric',
            'importe_total' => 'required | numeric',
            'estado' => 'required | string | in:pendiente,recibido,cancelado',
            'id_usuario' => 'required | integer',
            'id_proveedor' => 'required | integer',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $pedido = new Pedido($request->input());
        $pedido->save();

        return response()->json([
            'status' => true,
            'message' => 'Pedido creado con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver pedido');
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'status' => false,
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $pedido
        ], 200);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $this->authorize('actualizar pedido');
        $rules = [
            'fecha' => 'date',
            'cantidad' => 'integer',
            'precio_unitario' => 'numeric',
            'importe_total' => 'numeric',
            'estado' => 'string | in:pendiente,recibido,cancelado',
            'id_usuario' => 'integer',
            'id_proveedor' => 'integer',
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
        if ($request->has('cantidad')) {
            $data['cantidad'] = $request->input('cantidad');
        }
        if ($request->has('precio_unitario')) {
            $data['precio_unitario'] = $request->input('precio_unitario');
        }
        if ($request->has('importe_total')) {
            $data['importe_total'] = $request->input('importe_total');
        }
        if ($request->has('estado')) {
            $data['estado'] = $request->input('estado');
        }
        if ($request->has('id_usuario')) {
            $data['id_usuario'] = $request->input('id_usuario');
        }
        if ($request->has('id_proveedor')) {
            $data['id_proveedor'] = $request->input('id_proveedor');
        }
        $pedido->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Pedido actualizado con éxito'
        ], 200);
    }

    public function destroy(Pedido $pedido)
    {
        $this->authorize('eliminar pedido');
        $pedido->delete();
        return response()->json([
            'status' => true,
            'message' => 'Pedido eliminado con éxito'
        ], 200);
    }

    public function all()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
    }
}
