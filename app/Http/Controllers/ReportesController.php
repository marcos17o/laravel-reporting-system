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

    function check_in_range($date_start, $date_end, $date_now) {
        $date_start = strtotime($date_start);
        $date_end = strtotime($date_end);
        $date_now = strtotime($date_now);
        if (($date_now >= $date_start) && ($date_now <= $date_end))
            return true;
        return false;
     }

     function fechas($start, $end) {
        $range = array();
    
        if (is_string($start) === true) $start = strtotime($start);
        if (is_string($end) === true ) $end = strtotime($end);
    
        // if ($start > $end) return 'createDateRangeArray($end, $start)';
    
        do {
            $range[] = date('Y-m-d', $start);
            $start = strtotime("+ 1 month", $start);
        } while($start <= $end);
    
        return $range;
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

        $name_users = User::whereIn('co_usuario',$request->users)->select('name','co_usuario')->get();

        $data_start = date_create($request->data_start);

        $data_end = date_create($request->data_end);

    
        $year = date('Y', strtotime($request->data_start));
        $mes = date('m', strtotime($request->data_start));
        $date_to_start = $year."-".$mes.'-01';

        $year = date('Y', strtotime($request->data_end));
        $mes = date('m', strtotime($request->data_end));
        $date_to_end = $year."-".$mes.'-01';



        $range_date = $this->fechas($date_to_start, $date_to_end);

        $data_ordenada = [];
        $array_data = [];
        $v = 0;
        
        foreach ($name_users as $user_item) {
            
            foreach ($data as $data_item) {
                if ($user_item->co_usuario == $data_item->co_usuario) {

                    $valor = $data_item->valor;
                    $total_imp_inc = $data_item->total_imp_inc;

                    $mes_e = date('m', strtotime($data_item->data_emissao));

                    $v1 = $valor - (($valor*$total_imp_inc)/100);
                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));
                        if ( $mes_i == $mes_e) {
                            $array_data[$mes_i][] = (float) $v1;
                        }else{
                            $array_data[$mes_i][] = 0;
                        }
                    }
                }
            }

            foreach ($range_date as $range_d) {
                $mes_i = date('m', strtotime($range_d));
                if (isset($array_data[$mes_i])) {
                    $v = array_sum($array_data[$mes_i]);
                    $item_data[] = $v;
                }else{
                    $item_data[] = 0;
                }
            }

            $data_ordenada[] = [
                'name' => $user_item['name'],
                'data' => $item_data
            ];      
            
            $array_data = [];
            $item_data = [];
        }


        $request_data = $request->all();

        // if ($request->ajax()) {
        //     return response()->json(array('categories' =>$range_date, 'series' => $data_ordenada), 200);

        // }

        // $category_data = $range_date;
        $series_data = array('categories' =>$range_date, 'series' => $data_ordenada);
        
        return view('reports.grafica', compact('series_data'));

    }

}