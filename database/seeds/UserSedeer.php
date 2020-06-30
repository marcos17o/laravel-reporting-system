<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


            //Abrimos nuestro archivo
            $file = dirname(__FILE__);
            $file = str_replace('\\', '/',$file );
            $file = $file."/csv/cao_usuario.csv";

            $archivo = fopen($file, "r");
            //Lo recorremos
            while (($datos = fgetcsv($archivo, ",")) == true)
            {

            //Recorremos las columnas de esa linea

            User::create([
                    'co_usuario' => $datos[0],
                    'name'       => $datos[1],
                    'email'      => $datos[2],
                    'password'   =>  Hash::make($datos[3])
                ]);

            }
            //Cerramos el archivo
            fclose($archivo);
    }
}
