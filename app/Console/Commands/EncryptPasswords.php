<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class EncryptPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encrypt:passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt passwords in the usuarios table if they are not already encrypted.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            // Verificar si la contraseña no está cifrada
            if (!Hash::info($usuario->password)['algo']) {
                $usuario->password = Hash::make($usuario->password);
                $usuario->save();
                $this->info('Password encrypted for user with ID: ' . $usuario->id);
            } else {
                $this->info('Password already encrypted for user with ID: ' . $usuario->id);
            }
        }

        $this->info('Password encryption process completed.');
        return 0;
    }
}
