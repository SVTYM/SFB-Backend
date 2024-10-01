<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // Método para iniciar sesión
    public function login(Request $request)
    {
        $request->validate([
            'rfc' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('rfc', $request->rfc)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Autenticación exitosa
            Auth::login($usuario);
            return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
        }

        // Autenticación fallida
        return response()->json(['message' => 'RFC o contraseña incorrectos'], 401);
    }

    // Método para cambiar la contraseña
    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'rfc' => 'required|string',
            'new_password' => 'required|string|min:5',
        ]);

        $usuario = Usuario::where('rfc', $request->rfc)->first();

        if ($usuario) {
            $usuario->password = Hash::make($request->new_password);
            $usuario->save();

            return response()->json(['message' => 'Contraseña actualizada con éxito'], 200);
        }

        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}
