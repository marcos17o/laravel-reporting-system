@extends('layouts.app')

@section('content')
{{-- {{ dd($facturas) }} --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="text-center">
                    <h2>En construccion</h2>
                    <img src="https://static.wixstatic.com/media/404129_57320dafca4649a38b9f9e7f337e5c49~mv2.gif" alt="En contruccion">
                </div>
                <div class="card-header"><h2>List of factura</h2></div>

                @include('custom.mensaje')

                <div class="card-body">

                    {{-- @can('haveaccess', 'factura.create')
                        <a class="btn btn-primary float-right" href="{{ route('factura.create') }}">Create</a>
                        <br><br>
                    @endcan --}}

                    <table class="table table-hover table-responsive">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">num_nf</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Total Imp.</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Total</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $factura)
                            <tr>
                                <th scope="row">{{ $factura->id }}</th>
                                <td>{{ $factura->num_nf }}</td>
                                <td>{{ $factura->comissao_cn }} %</td>
                                <td>R$ {{ $factura->total_imp_inc }}</td>
                                <td>R$ {{ $factura->valor }}</td>
                                <td>R$ {{ $factura->total }}</td>
                                
                                {{-- <td>
                                    @can('haveaccess', 'factura.show')
                                        <a class="btn btn-success" href="{{ route('factura.show', $factura->id) }}">Show</a>
                                    @endcan

                                </td>
                                <td>
                                    @can('haveaccess', 'factura.edit')
                                        <a class="btn btn-info" href="{{ route('factura.edit', $factura->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                    @endcan
                                </td> --}}
                                <td>
                                    @can('haveaccess', 'factura.destroy')
                                        <form action="{{ route('factura.destroy', $factura->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{  $facturas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
