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

        return view('reports.grafica_pie', compact('data_users'));
    }


    function regla_de_tres($valor,$porcentaje){
        $total = (($porcentaje*$valor)/100);
        return $total;
    }

    function optener_salario($salarios,$id_consultor){
        // $id_consultor = (int) $id_consultor;
        $salarios_consultores = [];
        foreach ($salarios as $salario) {
            $salarios_consultores[$salario->user_id] = $salario->brut_salario;
        }
        return $salarios_consultores[$id_consultor];
    }

    function optener_valor_comision($valor,$porcentaje_imp,$porcentaje_comision){
        $valor_impuesto = $this->regla_de_tres($valor,$porcentaje_imp);
        $valor_bruto = ($valor - $valor_impuesto);
        $valor_comision = $this->regla_de_tres($valor_bruto,$porcentaje_comision);
        return $valor_comision;
    }

    function optener_valor_ganancias($valor, $porcentaje_imp){
        $valor_impuesto = $this->regla_de_tres($valor,$porcentaje_imp);
        $valor_ganancia = $valor - $valor_impuesto;
        return $valor_ganancia;
    }

    function optener_valor_lucro($ganancias,$salario,$comision){
        $valor_lucro = $ganancias - ($salario + $comision);
        return $valor_lucro;
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

        $array_data = [];


        foreach ($name_users as $user_item) {
            // separo los datos de cada consultor
            foreach ($data as $data_item) {
                if ($user_item->co_usuario == $data_item->co_usuario) {
                    $id_consultor         = $user_item->id;
                    $mes_e                = date('m', strtotime($data_item->data_emissao));
                    $consultor            = $user_item->name;
                    $valor                = $data_item->valor;
                    $porcentaje_imp       = $data_item->total_imp_inc;
                    $porcentaje_comision  = $data_item->comissao_cn;
                    
                    if (!isset(${'ganancias'.$id_consultor.'_'.$mes_e})) {
                        ${'ganancias'.$id_consultor.'_'.$mes_e} = 0;
                        ${'comision'.$id_consultor.'_'.$mes_e}  = 0;
                        ${'lucro'.$id_consultor.'_'.$mes_e}     = 0;

                        ${'total_ganancia_'.$id_consultor}      = 0;
                        ${'total_comision_'.$id_consultor}      = 0;
                        ${'total_salario_'.$id_consultor}       = 0;
                        ${'total_lucro_'.$id_consultor}         = 0;
                    }

                    ${'ganancias'.$id_consultor.'_mes_'.$mes_e} = $this->optener_valor_ganancias($valor, $porcentaje_imp);
                    ${'salario'.$id_consultor.'_mes_'.$mes_e}   = $this->optener_salario($salarios,$id_consultor);
                    ${'comision'.$id_consultor.'_mes_'.$mes_e}  = $this->optener_valor_comision($valor,$porcentaje_imp,$porcentaje_comision);
                


                    // organizo los datos por mes
                    foreach ($range_date as $range_d) {
                        $mes_i = date('m', strtotime($range_d));
                        $mes_i_texto = date('M, Y', strtotime($range_d));

                        if ($mes_i == $mes_e) {

                            ${'ganancias'.$id_consultor.'_'.$mes_e} += ${'ganancias'.$id_consultor.'_mes_'.$mes_e};
                            ${'comision'.$id_consultor.'_'.$mes_e}  += ${'comision'.$id_consultor.'_mes_'.$mes_e};
                            $lucro = $this->optener_valor_lucro( ${'ganancias'.$id_consultor.'_'.$mes_e},${'salario'.$id_consultor.'_mes_'.$mes_e},${'comision'.$id_consultor.'_'.$mes_e});
                            // empaqueto los datos
                            $array_data[$consultor][$mes_i_texto] = [
                                'fecha'     => $mes_i_texto,
                                'ganancias' => ${'ganancias'.$id_consultor.'_'.$mes_e},
                                'salario'   => ${'salario'.$id_consultor.'_mes_'.$mes_e},
                                'comision'  => ${'comision'.$id_consultor.'_'.$mes_e},
                                'lucro'     => $lucro
                            ];

                            ${'total_ganancia_'.$id_consultor}      += ${'ganancias'.$id_consultor.'_'.$mes_e};
                            ${'total_salario_'.$id_consultor}       += ${'salario'.$id_consultor.'_mes_'.$mes_e};
                            ${'total_comision_'.$id_consultor}      += ${'comision'.$id_consultor.'_'.$mes_e};
                            ${'total_lucro_'.$id_consultor}         += $lucro;
                            
                        }
                    }
                }
            }

            $total_consultor[$user_item->name] = [
                'ganancias' => ${'total_ganancia_'.$id_consultor},
                'salario'   => ${'total_salario_'.$id_consultor},
                'comision'  => ${'total_comision_'.$id_consultor},
                'lucro'     => ${'total_lucro_'.$id_consultor}
            ];

            ${'total_ganancia_'.$id_consultor}      = 0;
            ${'total_comision_'.$id_consultor}      = 0;
            ${'total_salario_'.$id_consultor}       = 0;
            ${'total_lucro_'.$id_consultor}         = 0;

        }   


        // return array_multisort($array_data, SORT_ASC);
        // return json_encode($total_consultor);


        return view('reports.grafica_tabla', compact('array_data', 'total_consultor'));

    }

}
