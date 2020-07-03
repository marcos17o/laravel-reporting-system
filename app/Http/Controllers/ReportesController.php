<?php

namespace App\Http\Controllers;

use App\Permission\Models\Factura;
use Illuminate\Http\Request;
use App\User;
use App\Permission\Models\Role;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::with('users')->where('id',3)->get();

        $data_role = json_decode($role[0],true);
        // $data_role = json_encode($data_role);
        // print_r($data_role);
        // $data_user = [];

        // exit();

        foreach ($data_role['users'] as $user) {
            $data_user[$user['co_usuario']] = $user['name'];
        }

        
        return view('reports.index', compact('role', 'data_user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {

    }

    public function get_data(Request $request)
    {
        $username = '';
        foreach ($request->users as $user) {
            $username .=  "'{$user}',";

            // `carlos.arruda`,`anapaula.chiodaro`,`edy.bruno"
        }
        $username = trim($username, ',');

        $sql_data = 'select cao_sistemas.co_usuario, facturas.data_emissao, facturas.total , facturas.valor, facturas.comissao_cn, facturas.total_imp_inc from facturas inner join `cao_sistemas` on facturas.co_sistema = cao_sistemas.co_sistema where `cao_sistemas`.`co_usuario` in ('.$username.') and facturas.data_emissao BETWEEN "'.$request->data_start.'" AND "'.$request->data_end.'"';

        $data = \DB::select(\DB::raw($sql_data));

        $request_data = $request->all();

        if ($request->ajax()) {
            return response()->json($data, 200);
            // return $username;
        }
        
        return compact('data');

    }




}
