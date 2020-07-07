<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>

    @php
        function compara_fecha($a, $b){
            return strtotime(trim($a['fecha'])) > strtotime(trim($b['fecha']));
        }
        function is_negative_number($number=0){
        if( is_numeric($number) AND ($number<0) ){
            return true;
        }else{
            return false;
        }
        }
    @endphp

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="mx-1">

        @foreach ($array_data as $consultor => $mes)
                <?php 
                usort($mes, 'compara_fecha');
                
                ?>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <th colspan="5" scope="col"><h2>{{ $consultor }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>Período</th>
                        <th>Receita Líquida</th>
                        <th>Custo Fixo</th>
                        <th>Comissão</th>
                        <th>Lucro</th>
                    </tr>
                    @foreach ($mes as $item)
                            <tr> 
                                <th>{{ $item['fecha'] }}</th>
                                <th class="<?php echo is_negative_number($item['ganancias']) ? 'text-danger': ''; ?>">{{ number_format($item['ganancias'], 2) }}</th>
                                <th class="<?php echo is_negative_number($item['salario']) ? 'text-danger': ''; ?>">- {{ number_format($item['salario'], 2) }}</th>
                                <th class="<?php echo is_negative_number($item['comision']) ? 'text-danger': ''; ?>">- {{ number_format($item['comision'],2) }}</th>
                                <th class="<?php echo is_negative_number($item['lucro']) ? 'text-danger': ''; ?>">{{ number_format($item['lucro'],2) }}</th>
                            </tr>
                    @endforeach
                    @foreach ($total_consultor as $user => $item_total)
                            @if ($user == $consultor)
                                <tr> 
                                    <th>SALDO</th>
                                    <th class="<?php echo is_negative_number($item['ganancias']) ? 'text-danger': ''; ?>">{{ number_format($item_total['ganancias'], 2) }}</th>
                                    <th class="<?php echo is_negative_number($item['salario']) ? 'text-danger': ''; ?>">- {{ number_format($item_total['salario'], 2) }}</th>
                                    <th class="<?php echo is_negative_number($item['comision']) ? 'text-danger': ''; ?>">- {{ number_format($item_total['comision'],2) }}</th>
                                    <th class="<?php echo is_negative_number($item['lucro']) ? 'text-danger': ''; ?>">{{ number_format($item_total['lucro'],2) }}</th>
                                </tr>
                            @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
</div>

</html>
