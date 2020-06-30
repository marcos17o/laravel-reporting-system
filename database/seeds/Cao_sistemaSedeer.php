<?php

use Illuminate\Database\Seeder;
use App\Permission\Models\Cao_sistema;

class Cao_sistemaSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('');
         //Abrimos nuestro archivo
         $file = dirname(__FILE__);
         $file = str_replace('\\', '/',$file );
         $file = $file."/csv/cao_sistema.csv";

         $archivo = fopen($file, "r");
         //Lo recorremos
         while (($datos = fgetcsv($archivo, ",")) == true)
         {

         //Recorremos las columnas de esa linea


         Cao_sistema::create([
                 'co_sistema'         => $datos[0],
                 'co_cliente'         => $datos[1],
                 'co_usuario'         => $datos[2],
                 'co_arquitetura'     => $datos[3],
                 'no_sistema'         => $datos[4],
                 'ds_sistema_resumo'  => $datos[5],
                 'ds_caracteristica'  => $datos[6],
                 'ds_requisito'       => $datos[7],
                 'no_diretoria_solic' => $datos[8],
                 'ddd_telefone_solic' => $datos[9],
                 'nu_telefone_solic'  => $datos[10],
                 'no_usuario_solic'   => $datos[11],
                 'dt_solicitacao'     => $datos[12],
                 'dt_entrega'         => $datos[13],
                 'co_email'           => $datos[14],
             ]);

         }
         //Cerramos el archivo
         fclose($archivo);
    }
}
