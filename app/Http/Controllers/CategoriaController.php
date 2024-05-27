<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function store(Request $request)
    {
        $this->authorize('crear categoria');
        $rules = [
            'nombre' => 'required | string | min:1 | max:55',
            'descripcion' => 'nullable | string',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $categoria = new Categoria($request->input());
        $categoria->save();

        return response()->json([
            'status' => true,
            'message' => 'Categoria creada con éxito'
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('ver categoria');
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'message' => 'Caategoría no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $categoria
        ], 200);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $this->authorize('editar categoria');
        $rules = [
            'nombre' => 'string | min:1 | max:255',
            'descripcion' => 'nullable | string',
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
        $categoria->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Categoria actualizada con exito'
        ], 200);
    }

    public function destroy(Categoria $categoria)
    {
        $this->authorize('eliminar categoria');
        $categoria->delete();
        return response()->json([
            'status' => true,
            'message' => 'Categoria eliminada con exito'
        ], 200);
    }

    public function all()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
}
