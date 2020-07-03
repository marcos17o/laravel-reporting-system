@extends('layouts.app')

@section('content')
@isset($data)
    {{-- {{ dd($request_data) }} --}}

    <table>
        
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->co_usuario}}</td>
            <td>{{ $item->valor}}</td>
            <td>{{ $item->total}}</td>
            <td>{{ $item->comissao_cn }}</td>
            <td>{{ $item->data_emissao }}</td>
        </tr>
        @endforeach
    </table>
    
@endisset
{{-- {{ $role }} --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="text-center">
                <h2>En construccion</h2>
                <img src="https://static.wixstatic.com/media/404129_57320dafca4649a38b9f9e7f337e5c49~mv2.gif" alt="En contruccion">
            </div>
                
            <div class="card">
                <div class="card-header"><h2>Reportes (Solo usuarios con el rol Consultor)</h2></div>
                
                @include('custom.mensaje')

                <div class="card-body">
                    <div class="row" >
                        
                        {!! Form::open(['route'=> 'reports.get_data', 'method'=>'POST', 'role' => 'form', 'id' => 'formulario-reporte-1', 'class' => '']) !!}
                            <div  class="form-group">
                                
                                {!! Form::select('users[]', $data_user, null, ['class' => 'js-example-responsive', 'style'=> 'width:90%', 'multiple'=> 'multiple','id' => 'list1', 'required' => 'required']) !!}
                            </div>

                            <div  class="form-group">
                                
                                {!! Form::date('data_start', false, ['class'=> 'form-control','required' => 'required']) !!}
                                {!! Form::date('data_end', false, ['class'=> 'form-control', 'required' => 'required']) !!}

                            </div>

                            {!! Form::submit('Submit', ['class' => 'btn-enviar-data btn btn-primary']) !!}
                                
                        {!! Form::close() !!}
                    </div>

                    <br><br>
                    <hr>


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

<script src="{{ asset('js/reporting.js') }}" defer></script>
<script src="{{ asset('js/select2-config.js') }}"></script>


@endsection