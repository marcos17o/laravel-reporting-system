@extends('layouts.app')

@section('content')
{{-- {{ dd($facturas) }} --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header"><h2>List of factura</h2></div>

                @include('custom.mensaje')

                <div class="card-body">

                    @can('haveaccess', 'factura.create')
                        <a class="btn btn-primary float-right" href="{{ route('factura.create') }}">Create</a>
                        <br><br>
                    @endcan

                    <table class="table table-hover table-responsive">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">slug</th>
                                <th scope="col">description</th>
                                <th scope="col">Full ccess</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $factura)
                            <tr>
                                <th scope="row">{{ $factura->id }}</th>
                                <td>{{ $factura->name }}</td>
                                <td>{{ $factura->slug }}</td>
                                <td>{{ $factura->description }}</td>
                                <td>{{ $factura["full-access"] }}</td>
                                <td>
                                    @can('haveaccess', 'factura.show')
                                        <a class="btn btn-success" href="{{ route('factura.show', $factura->id) }}">Show</a>
                                    @endcan

                                </td>
                                <td>
                                    @can('haveaccess', 'factura.edit')
                                        <a class="btn btn-info" href="{{ route('factura.edit', $factura->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                    @endcan
                                </td>
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
