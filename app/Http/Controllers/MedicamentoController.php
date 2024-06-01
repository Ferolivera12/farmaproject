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

    public function update(Request $request, Medicamento $medicamento)
    {
        //$this->authorize('editar medicamento');
        $rules = [
            'nombre' => 'string | max:255',
            'descripcion' => 'string | max:255',
            'fechavencimiento' => 'date',
            'categoria' => 'string | max:255',
            'cantidad' => 'integer',
            'precio' => 'numeric',
            'laboratorio' => 'string | max:255',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = [];
        if ($request->has('nombre')) {
            $data['nombre'] = $request->input('nombre');
        }
        if ($request->has('descripcion')) {
            $data['descripcion'] = $request->input('descripcion');
        }
        if ($request->has('fechavencimiento')) {
            $data['fechavencimiento'] = $request->input('fechavencimiento');
        }
        if ($request->has('categoria')) {
            $data['categoria'] = $request->input('categoria');
        }
        if ($request->has('cantidad')) {
            $data['cantidad'] = $request->input('cantidad');
        }
        if ($request->has('precio')) {
            $data['precio'] = $request->input('precio');
        }
        if ($request->has('laboratorio')) {
            $data['laboratorio'] = $request->input('laboratorio');
        }
        $medicamento->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Medicamento actualizado con éxito',
        ], 200);
    }

    public function destroy(Medicamento $medicamento)
    {
        //$this->authorize('eliminar medicamento');
        $medicamento->delete();
        return response()->json([
            'status' => true,
            'message' => 'Medicamento eliminado con éxito'
        ], 200);
    }

    public function all()
    {
        $medicamentos = Medicamento::all();
        return response()->json($medicamentos);
    }
}
