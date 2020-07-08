@extends('layouts.reporting')

@section('content')
{{-- {{ dd($array_dates) }}
{{ die()}} --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            {{-- <div class="text-center">
                <h2>En construccion</h2>
                <img src="https://static.wixstatic.com/media/404129_57320dafca4649a38b9f9e7f337e5c49~mv2.gif" alt="En contruccion">
            </div> --}}


                <div class=""><h2>Reportes</h2></div>

                <div class="col-12 msg"></div>

                @include('custom.mensaje')



                        {!! Form::open([null, null, 'role' => 'form', 'id' => 'formulario-reporte', 'class' => '']) !!}


                        <div class="form-row text-aling ">
                            <div class="col-md-3 float-left">
                                {!! Form::label('data_start', 'Desde') !!}
                                {!! Form::date('data_start', $array_dates[0], ['id' => 'data_start', 'class'=> 'form-control','required' => 'required', 'min' => $array_dates[0], 'max' => $array_dates[1] ]) !!}
                            </div>

                            <div class="col-md-3 float-left col-12">
                                {!! Form::label('data_end', 'Hasta') !!}
                                {!! Form::date('data_end', $array_dates[1], ['id' => 'data_end', 'class'=> 'form-control', 'required' => 'required', 'min' => $array_dates[0], 'max' => $array_dates[1]]) !!}
                            </div>

                            <div class="col-md-6 col-12">
                                {!! Form::label('list1', 'Lista de Consultores') !!}
                                {!! Form::select('users[]', $data_user, null, ['data-live-search' => "true", 'class' => 'form-control', 'multiple'=> 'multiple','id' => 'list1', 'required' => 'required']) !!}
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col-md-4 col-12 my-3 my-md-1">
                                {!! Form::button('Relatório', ['type' => 'submit', 'class' => 'btn-data-relatorio btn btn-primary btn-lg btn-block'])  !!}
                            </div>

                            <div class="col-md-4 col-12 my-3 my-md-1">
                                {!! Form::button('<i class="fas fa-chart-bar"></i> Gráfico', ['type' => 'submit', 'class' => 'btn-data-grafica btn btn-primary btn-lg btn-block'])  !!}
                            </div>

                            <div class="col-md-4 col-12 my-3 my-md-1">
                                {!! Form::button('<i class="fas fa-chart-pie"></i> Pizza', ['type' => 'submit', 'class' => 'btn-data-torta btn btn-primary btn-lg btn-block'])  !!}
                            </div>


                        </div>

                        {!! Form::close() !!}

                    <br><br>
                    <hr>

                    <div class="col-12 p-0 m-2 text-center">
                        <div id="grafica">

                        </div>
                    </div>


    </div>
</div>
@endsection

@section('scripts_header')


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

@endsection

@section('scripts_footer')

<script src="{{ asset('js/reporting.js?ver=1.1') }}" defer></script>

<script type="text/javascript">
$.fn.selectpicker.Constructor.BootstrapVersion = '4';

        $('#list1').selectpicker();

</script>



@endsection
