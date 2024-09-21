<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PaginacionPosicion;

class PosicionController extends Controller
{
    public function show($id_contrato)
    {
        // Hacer la solicitud a la URL de la API para obtener el JSON
        $response = Http::get('http://sfb.xromsys.com/ajax/app.php', [
            'opcion' => 2,
            'id_contrato' => $id_contrato
        ]);

        // Comprobar si la solicitud fue exitosa
        if ($response->successful()) {
            // Decodificar el JSON en un array asociativo
            $data = $response->json();

            // Crear una instancia de la clase PaginacionPosicion
            $paginacionPosicion = new PaginacionPosicion($data);

            // Retornar la información en formato JSON
            return response()->json($paginacionPosicion);
        }

        // Si la solicitud falla, retornar un error
        return response()->json(['error' => 'No se pudieron obtener los datos'], 500);
    }
}
