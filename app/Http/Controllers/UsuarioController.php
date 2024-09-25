<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::with('contratos')->get();
        return response()->json($usuarios);
    }

    // Mostrar un usuario específico
    public function show($id_usuario)
    {
        $usuario = Usuario::with('contratos')->findOrFail($id_usuario);
        return response()->json($usuario);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json(null, 204);
    }


    
    public function login(Request $request)
{
    // Verificar los valores recibidos en Laravel
    \Log::info('Login intent: ', ['usuario' => $request->input('usuario'), 'password' => sha1($request->input('password'))]);

    // Validación de los campos recibidos
    $request->validate([
        'usuario' => 'required|string',
        'password' => 'required|string',
    ]);

    // Obtener los datos del formulario
    $usuario = $request->input('usuario');
    $password = $request->input('password');

    // Convertir la contraseña ingresada en SHA1
    $hashedPassword = sha1($password);

    // Intentar encontrar un usuario con las credenciales proporcionadas
    $user = Usuario::where('usuario', $usuario)
        ->where('password', $hashedPassword)
        ->first();

    // Verificar si las credenciales son correctas
    if ($user) {
        return response()->json([
            'access' => true,
            'id_usuario' => $user->id_usuario,
            'usuario' => $user->usuario,
            'nombre' => $user->nombre,
            'perfil' => $user->perfil,
            'message' => 'Inicio de sesión exitoso',
        ]);
    } else {
        // Si las credenciales son incorrectas
        \Log::warning('Credenciales incorrectas para el usuario: '.$usuario);
        return response()->json([
            'access' => false,
            'message' => 'Credenciales incorrectas',
        ], 401); // Código HTTP 401 Unauthorized
    }
}

}
