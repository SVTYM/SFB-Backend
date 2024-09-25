<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    // Listar todas las tareas
    public function index()
    {
        $tareas = Tarea::with('contrato')->get();
        return response()->json($tareas);
    }

    // Mostrar una tarea específica
    public function show($id)
    {
        $tarea = Tarea::with('contrato')->findOrFail($id);
        return response()->json($tarea);
    }

    // Crear una nueva tarea
    public function store(Request $request)
    {
        $tarea = Tarea::create($request->all());
        return response()->json($tarea, 201);
    }

    // Actualizar una tarea existente
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        return response()->json($tarea, 200);
    }

    // Eliminar una tarea
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return response()->json(null, 204);
    }
}
