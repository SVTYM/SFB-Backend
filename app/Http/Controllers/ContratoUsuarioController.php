<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Usuario;

class ContratoUsuarioController extends Controller
{
    // Asignar usuarios a un contrato
    public function attachUsersToContrato(Request $request, $id_contrato)
    {
        $contrato = Contrato::findOrFail($id_contrato);
        $usuario_ids = $request->input('usuario_ids');
        
        // Adjuntar usuarios al contrato (relación muchos a muchos)
        $contrato->usuarios()->attach($usuario_ids);
        return response()->json(['message' => 'Usuarios asignados correctamente.']);
    }

    // Eliminar usuarios de un contrato
    public function detachUsersFromContrato(Request $request, $id_contrato)
    {
        $contrato = Contrato::findOrFail($id_contrato);
        $usuario_ids = $request->input('usuario_ids');
        
        // Quitar usuarios de la relación con el contrato
        $contrato->usuarios()->detach($usuario_ids);
        return response()->json(['message' => 'Usuarios eliminados del contrato correctamente.']);
    }

    // Obtener usuarios asignados a un contrato
    public function getUsersByContrato($id_contrato)
    {
        $contrato = Contrato::with('usuarios')->findOrFail($id_contrato);
        return response()->json($contrato->usuarios);
    }
}
