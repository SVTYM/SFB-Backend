<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Validar la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Máximo 2MB
        ]);

        // Almacenar la imagen en el sistema de archivos
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Guardar la imagen en la carpeta 'public/images'
            $path = $image->store('public/images');

            // Puedes obtener la URL de la imagen si está almacenada en el disco 'public'
            $url = Storage::url($path);

            // Retornar una respuesta con la URL de la imagen
            return response()->json([
                'message' => 'Imagen subida exitosamente.',
                'url' => $url
            ], 200);
        }

        return response()->json([
            'message' => 'No se ha subido ninguna imagen.'
        ], 400);
    }
}
