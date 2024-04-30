<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; # Importamos la libreria para poder realizar peticiones

# Importamos el modelo User para hacer uso de el y las siguientes librerias para poder autentificar y generar TOKENS
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; # hacemos uso de la clase "Hash" para encriptar contraseñas
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        $users = Usuario::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | string | min:1 | max:20',
            'lastname' => 'required | string | min:1 | max:20',
            'email' => 'required | email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $user = new Usuario([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')) # Encriptar la contraseña

        ]);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado con éxito',
            'token' => $user->createToken('api-token')->plainTextToken # Es aqui donde retornamos el token
        ], 200);
    }

    # Funcion para logear a un usuario
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required | email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Usuario no autorizado']
            ], 401);
        }

        $user = Usuario::where('email', $request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'Usuario ingresado exitosamente',
            'token' => $user->createToken('api-token')->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            // Revocar todos los tokens del usuario actual
            $request->user()->tokens()->delete();
        }
        // Eliminar al usuario del guardia autenticado
        auth()->logout();

        return response()->json([
            'status' => true,
            'message' => 'Usuario cerrado con éxito',
        ], 200);
    }

    public function show($id)
    {
        $user = Usuario::find($id);  // Encuentra al usuario por ID

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }


    public function update(Request $request, Usuario $user)
    {
        $rules = [
            'name' => 'nullable | string | min:1 | max:20',
            'lastname' => 'nullable | string | min:1 | max:20',
            'email' => 'nullable | email',
            'password' => 'nullable'
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        # Actualizacion de los valores si no son nulos
        $data = [];
        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }
        if ($request->has('lastname')) {
            $data['lastname'] = $request->input('lastname');
        }
        if ($request->has('email')) {
            $data['email'] = $request->input('email');
        }
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado exitosamente'
        ], 200);
    }

    public function destroy(Usuario $user)
    {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Usuario eliminado exitosamente'
        ], 200);
    }
}
