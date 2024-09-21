<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Paginacion;


class PaginacionController extends Controller
{
    public function index()
    {
        // Hacer la solicitud a la URL para obtener el JSON
        $response = Http::get('http://sfb.xromsys.com/ajax/app.php?opcion=1');

        // Comprobar si la solicitud fue exitosa
        if ($response->successful()) {
            // Decodificar el JSON en un array asociativo
            $data = $response->json();

            // Crear una instancia de la clase Paginacion
            $paginacion = new Paginacion($data);

            // Retornar la información en formato JSON
            return response()->json($paginacion);
        }

        // Si la solicitud falla, retornar un error
        return response()->json(['error' => 'No se pudo obtener los datos'], 500);
    }
}
