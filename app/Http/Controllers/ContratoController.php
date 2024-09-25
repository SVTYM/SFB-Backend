<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoController extends Controller
{
    // Listar todos los contratos
    public function index()
    {
        $contratos = Contrato::with('tareas', 'usuarios')->get();
        return response()->json($contratos);
    }

    // Mostrar un contrato específico
    public function show($id)
    {
        $contrato = Contrato::with('tareas', 'usuarios')->findOrFail($id);
        return response()->json($contrato);
    }

    // Crear un nuevo contrato
    public function store(Request $request)
    {
        $contrato = Contrato::create($request->all());
        return response()->json($contrato, 201);
    }

    // Actualizar un contrato existente
    public function update(Request $request, $id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());
        return response()->json($contrato, 200);
    }

    // Eliminar un contrato
    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();
        return response()->json(null, 204);
    }

    // Listar contratos por id_usuario con tareas relacionadas
    public function getContratosByUsuario($id_usuario)
    {
        // Obtener los contratos relacionados al id_usuario con las tareas
        $contratos = Contrato::whereHas('usuarios', function($query) use ($id_usuario) {
            $query->where('usuarios.id_usuario', $id_usuario);
        })
        ->with('tareas') // Incluir las tareas relacionadas
        ->get();

        // Si no se encuentran contratos, se retorna un mensaje de error
        if ($contratos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron contratos para este usuario.'], 404);
        }

        // Retornar los contratos con las tareas
        return response()->json($contratos);
    }
}
