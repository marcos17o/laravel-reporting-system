<?php

namespace App\Http\Controllers;

use App\Permission\Models\Factura;
use Illuminate\Http\Request;
use App\User;
use App\Permission\Models\Role;
use App\Permission\Models\Salario;

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

        // $date_init = Factura::orderBy('data_emissao','ACS')->limit(1)->get();
        // $date_end = Factura::orderBy('data_emissao','DESC')->limit(1)->get();

        $date_init = Factura::orderBy('data_emissao', 'asc')->limit(1)->get('data_emissao');
        $date_end  = Factura::orderBy('data_emissao', 'desc')->limit(1)->get('data_emissao');

        $array_dates = array($date_init[0]->data_emissao, $date_end[0]->data_emissao);


        return view('reports.index', compact('role', 'data_user','array_dates'));
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
            $range[] = date('Y M', $start);
            $start = strtotime("+ 1 month", $start);
        } while($start <= $end);

        return $range;
    }

    public function get_data_grafica(Request $request)
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

        // $request_data = $request->all();

        $series_data = array('categories' =>$range_date, 'series' => $data_ordenada);

        return view('reports.grafica', compact('series_data'));

    }

    public function get_data_grafica_torta(Request $request){
        $username = '';
        foreach ($request->users as $user) {
            $username .=  "'{$user}',";

            // `carlos.arruda`,`anapaula.chiodaro`,`edy.bruno"
        }
        $username = trim($username, ',');
        $sql_data = 'select cao_sistemas.co_usuario, facturas.data_emissao, facturas.total , facturas.valor, facturas.comissao_cn, facturas.total_imp_inc from facturas inner join `cao_sistemas` on facturas.co_sistema = cao_sistemas.co_sistema where `cao_sistemas`.`co_usuario` in ('.$username.') and facturas.data_emissao BETWEEN "'.$request->data_start.'" AND "'.$request->data_end.'"';

        $data = \DB::select(\DB::raw($sql_data));

        $name_users = User::whereIn('co_usuario',$request->users)->select('name','co_usuario')->get();

        $data_users           = [];
        $array_data           = [];
        $all_valores          = [];
        $all_valores_users    = [];

        foreach ($name_users as $user_item) {

            foreach ($data as $data_item) {
                if ($user_item->co_usuario == $data_item->co_usuario) {

                    $valor = $data_item->valor;
                    $total_imp_inc = $data_item->total_imp_inc;

                    $v1 = $valor - (($valor*$total_imp_inc)/100);

                    array_push( $array_data, (float) $v1);

                }
            }
            $e = array_sum($array_data);
            $all_valores_users[$user_item->name] = $e;
            array_push($all_valores, $e);

            $array_data = [];
            $item_data = [];
        }

        $tatal_valores = array_sum($all_valores);

        foreach ($name_users as $user_item) {
            foreach ($all_valores_users as $key => $value_user) {
                # code...
                if ($user_item->name == $key) {

                    $y = (($value_user * 100) / $tatal_valores);

                    $data_users[] = [
                        'name' => $user_item->name,
                        'y'    =>  $y
                    ];
                }
            }
        }

        // return response()->json($data_users,200);

        // $series_data = array('categories' =>$range_date, 'series' => $data_ordenada);
        return view('reports.grafica_pie', compact('data_users'));
    }

    public function get_data_relatorio(Request $request)
    {
        $salarios = Salario::get();
        $username = '';
        foreach ($request->users as $user) {
            $username .=  "'{$user}',";

            // `carlos.arruda`,`anapaula.chiodaro`,`edy.bruno"
        }
        $username = trim($username, ',');
        $sql_data = 'select cao_sistemas.co_usuario, facturas.data_emissao, facturas.total , facturas.valor, facturas.comissao_cn, facturas.total_imp_inc from facturas inner join `cao_sistemas` on facturas.co_sistema = cao_sistemas.co_sistema where `cao_sistemas`.`co_usuario` in ('.$username.') and facturas.data_emissao BETWEEN "'.$request->data_start.'" AND "'.$request->data_end.'"';

        $data = \DB::select(\DB::raw($sql_data));

        $name_users = User::whereIn('co_usuario',$request->users)->select('id','name','co_usuario')->get();

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
        $array_data    = [];
        $receita_l     = [];
        $comision_l    = [];
        $lucro_i       = [];
        $v             = 0;
        $v2            = 0;
        $v3            = 0;

        foreach ($name_users as $user_item) {

            foreach ($data as $data_item) {
                if ($user_item->co_usuario == $data_item->co_usuario) {

                    $valor         = $data_item->valor;
                    $total_imp_inc = $data_item->total_imp_inc;
                    $comision      = $data_item->comissao_cn;

                    foreach ($salarios as $salario) {
                        if ($salario->user_id == $user_item->id) {
                            $brut_salario = $salario->brut_salario;
                        }
                    }
                    $mes_e = date('m', strtotime($data_item->data_emissao));

                    $receita_liquida = $valor - (($valor*$total_imp_inc)/100);

                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));
                        if ( $mes_i == $mes_e) {
                            $receita_l[] = $receita_liquida;
                        }
                    }

                    $comision_item = $valor - (($valor*$total_imp_inc)*$data_item->comissao_cn);
                    // comisión = (VALOR – (VALOR*TOTAL_IMP_INC))*COMISSAO_CN

                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));
                        if ( $mes_i == $mes_e) {
                            $comision_l[] = $comision_item;
                        }
                    }

                    $lucro_item = ($receita_liquida - ($brut_salario + $comision_item));
                    // Lucro = (VALOR-TOTAL_IMP_INC) – (Costo fijo + comisión).

                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));
                        if ( $mes_i == $mes_e) {
                            $lucro_i[] = $lucro_item;
                        }
                    }


                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));

                        if ( $mes_i == $mes_e) {
                            $array_data[$mes_i][] = [
                                'receita_liquida' => array_sum($receita_l),
                                'brut_salario'    => $brut_salario,
                                'comision'        => $comision_l,
                                'lucro'           => $lucro_i
                            ] ;
                        }else{
                            $array_data[$mes_i][] = [
                                'receita_liquida' => 0,
                                'brut_salario'    => $brut_salario,
                                'comision'        => 0,
                                'lucro'           => 0
                            ];
                        }
                    }

                }
            }

            foreach ($range_date as $range_d) {
                $mes_i = date('m', strtotime($range_d));
                $mes_i_texto = date('Y M', strtotime($range_d));
                if (isset($array_data[$mes_i])) {

                    foreach ($array_data[$mes_i] as $item_mes) {
                        $v += $item_mes['receita_liquida'];
                    }

                    foreach ($array_data[$mes_i] as $item_mes) {
                        $v2 += $item_mes['receita_liquida'];
                    }

                    // foreach ($array_data[$mes_i] as $item_mes) {
                    //     $v3 += $item_mes['lucro'];
                    // }

                    $item_data[] = [
                        'name_mes'        => $mes_i_texto,
                        'receita_liquida' => $v,
                        'brut_salario'    => $brut_salario,
                        'comision'        => $v2,
                        // 'lucro'           => $array_data[$mes_i]['lucro']
                    ];
                }else{
                    $item_data[] = [
                        'name_mes'        => $mes_i_texto,
                        'receita_liquida' => 0,
                        'brut_salario'    => $brut_salario,
                        'comision'        => 0,
                        // 'lucro'           => $v3
                    ];
                }
            }

            $data_ordenada[] = [
                'name' => $user_item['name'],
                'data' => $item_data
            ];

            $array_data = [];
            $item_data = [];
        }

        // $request_data = $request->all();

        return json_encode($data_ordenada);

        // $series_data = array('categories' =>$range_date, 'series' => $data_ordenada);

        // return view('reports.grafica', compact('series_data'));

    }

}
