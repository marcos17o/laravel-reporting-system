<?php

use Illuminate\Database\Seeder;
use App\Permission\Models\Factura;

class FacturasSedeer extends Seeder
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
        $file = $file."/csv/cao_fatura.csv";

        $archivo = fopen($file, "r");
        //Lo recorremos
        while (($datos = fgetcsv($archivo, ",")) == true)
        {

        //Recorremos las columnas de esa linea

        Factura::create([
                // 'co_fatura'         => $datos[0], // este campo es el id de esta tabla
                'co_cliente'         => $datos[1],
                'co_sistema'         => $datos[2],
                'co_os'              => $datos[3],
                'num_nf'             => $datos[4],
                'total'              => $datos[5],
                'valor'              => $datos[6],
                'data_emissao'       => $datos[7],
                'corpo_nf'           => $datos[8],
                'comissao_cn'        => $datos[9],
                'total_imp_inc'      => $datos[10]
            ]);

        }
        //Cerramos el archivo
        fclose($archivo);
    }
}
