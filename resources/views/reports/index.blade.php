@extends('layouts.app')

@section('content')
{{-- {{ $role }} --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            {{-- <div class="text-center">
                <h2>En construccion</h2>
                <img src="https://static.wixstatic.com/media/404129_57320dafca4649a38b9f9e7f337e5c49~mv2.gif" alt="En contruccion">
            </div> --}}
                
            <div class="card">
                <div class="card-header"><h2>Reportes (Solo usuarios con el rol Consultor)</h2></div>
                
                @include('custom.mensaje')

                <div class="card-body">
                    <div class="h-100" >
                        
                        {!! Form::open(['route'=> 'reports.get_data', 'method'=>'POST', 'role' => 'form', 'id' => 'formulario-reporte-1', 'class' => 'col-12']) !!}
                        <div class="row">

                            <div  class="form-group col-2">
                            
                                {!! Form::date('data_start', false, ['class'=> 'form-control','required' => 'required']) !!}

                                {!! Form::date('data_end', false, ['class'=> 'form-control', 'required' => 'required']) !!}
                            </div>

                            <div  class="form-group col">

                                {!! Form::select('users[]', $data_user, null, ['class' => 'form-control js-example-responsive ', 'style'=> 'width:90%', 'multiple'=> 'multiple','id' => 'list1', 'required' => 'required']) !!}
                            </div>
                            <div  class="form-group">

                                {!! Form::submit('Submit', ['class' => 'btn-enviar-data btn btn-primary']) !!}
                            </div>
                        </div>
                                
                        {!! Form::close() !!}
                    </div>

                    <br><br>
                    <hr>

                    <div class="col-12 p-0 m-2 text-center">
                        <div id="grafica">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection

@section('scripts_header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.min.css') }}">


@endsection

@section('scripts_footer')
{{-- <script src="{{ asset('js/move.js') }}" defer></script> --}}

<script src="{{ asset('js/reporting.js?ver=3') }}" defer></script>
{{-- <script src="{{ asset('js/grafica.js') }}"></script> --}}
<script src="{{ asset('js/select2-config.js') }}"></script>


@endsection