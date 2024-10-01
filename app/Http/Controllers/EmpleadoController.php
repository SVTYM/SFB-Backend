<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    // Método para sincronizar empleados desde la URL
    public function syncEmpleados()
{
    // URL que devuelve el JSON con los datos de empleados
    $url = 'http://sfb.xromsys.com/ajax/app.php?opcion=10010';

    // Realizar una solicitud GET a la URL
    $response = Http::get($url);

    // Verificar si la solicitud fue exitosa
    if ($response->successful()) {
        // Obtener el contenido de la respuesta JSON
        $empleadosData = $response->json();

        // Verificar si los datos obtenidos son un arreglo
        if (is_array($empleadosData)) {
            foreach ($empleadosData as $empleadoData) {
                // Omite el empleado si 'rfc' es null o vacío
                if (empty($empleadoData['rfc'])) {
                    \Log::info('Empleado omitido debido a RFC nulo o vacío', ['empleadoData' => $empleadoData]);
                    continue;
                }

                // Buscar y actualizar o crear al empleado
                $empleado = Empleado::updateOrCreate(
                    ['id_empleado' => $empleadoData['id_empleado']],
                    [
                        'tipo_empleado' => $empleadoData['tipo_empleado'],
                        'nombres' => $empleadoData['nombres'],
                        // Verificar y cifrar la clave solo si no está ya cifrada
                        'clave' => !empty($empleadoData['clave']) && !Hash::needsRehash($empleadoData['clave']) ? Hash::make($empleadoData['clave']) : $empleadoData['clave'],
                        'rfc' => $empleadoData['rfc'],
                        'puesto' => $empleadoData['puesto'],
                        'email' => $empleadoData['email'],
                        'estado' => $empleadoData['estado'],
                    ]
                );
                

                // Verificar si ya existe un usuario con el mismo id_empleado o rfc
                $usuario = Usuario::where('id_empleado', $empleado->id_empleado)
                                  ->orWhere('rfc', $empleadoData['rfc'])
                                  ->first();

                if (!$usuario) {
                    // Crear un usuario asociado con contraseña por defecto
                    $usuario = Usuario::create([
                        'id_empleado' => $empleado->id_empleado,
                        'rfc' => $empleadoData['rfc'],
                        'password' => Hash::make('12345678'), // Contraseña por defecto
                    ]);

                    // Registrar la creación del usuario
                    \Log::info('Usuario creado:', ['id' => $usuario->id, 'id_empleado' => $usuario->id_empleado]);
                } else {
                    // Actualizar el usuario existente si es necesario (opcional)
                    \Log::info('Usuario ya existe:', ['id' => $usuario->id, 'rfc' => $usuario->rfc]);
                }
            }

            return response()->json(['message' => 'Empleados sincronizados correctamente'], 200);
        } else {
            \Log::error('Error: La respuesta JSON no es un arreglo.', ['empleadosData' => $empleadosData]);
            return response()->json(['message' => 'Datos no válidos recibidos'], 500);
        }
    }

    \Log::error('Error al obtener datos de empleados', [
        'status' => $response->status(), 
        'response' => $response->body()
    ]);

    return response()->json(['message' => 'Error al obtener datos de empleados'], 500);
}



public function login(Request $request)
{
    // Primero sincronizamos los empleados
    $this->syncEmpleados();

    // Validar los datos de entrada
    $request->validate([
        'rfc' => 'required|string',
        'clave' => 'required|string',
    ]);

    // Buscar el usuario por RFC
    $usuario = Usuario::where('rfc', $request->rfc)->first();

    // Verificar si el usuario existe y si la clave es correcta
    if ($usuario && Hash::check($request->clave, $usuario->password)) {
        // Obtener los detalles del empleado asociado
        $empleado = Empleado::where('id_empleado', $usuario->id_empleado)->first();

        // Verificar si el empleado está activo
        if ($empleado && $empleado->estado == 1) {
            return response()->json(['message' => 'Inicio de sesión exitoso', 'empleado' => $empleado], 200);
        }
    }

    // Inicio de sesión fallido
    return response()->json(['message' => 'RFC o clave incorrectos'], 401);
}


}
