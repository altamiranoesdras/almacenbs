<?php

namespace App\Imports;

use App\Models\Configuration;
use App\Models\User;
use App\Notifications\EnviarEnlaceNotificacion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EnviarEnlaceUsuarios implements ToCollection,WithHeadingRow
{

    use Importable;

    public $errores;

    public function __construct()
    {
        $configurations = Configuration::pluck('value','key')->toArray();

        foreach ($configurations as $key => $value){
            config(['app.'.$key => $value]);
        }

        $this->errores = collect();
    }


    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {




        foreach ($collection as $index => $fila) {
            $username = $fila["username"] ?? null;
            $name = $fila["name"] ?? null;
            $unidad_solicitante = $fila["unidad_solicitante"] ?? null;
            $cargo = $fila["cargo"] ?? null;
            $email = $fila["email"] ?? null;
            $bodega_o_sede = $fila["bodega_o_sede"] ?? null;

            $usuario = User::whereUsername($username)->first();


            if ($usuario){

                $usuario->email =$email;
                $usuario->save();


                try {

                    $usuario->notify(new EnviarEnlaceNotificacion());

                }catch (\Exception $exception){
                    $this->errores->push("Error al enviar correo a ",$email);
                }


            }

        }
    }
}
