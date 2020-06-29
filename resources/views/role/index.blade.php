@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header"><h2>List of Role</h2></div>

                @include('custom.mensaje')

                <div class="card-body">

                    @can('haveaccess', 'role.create')
                        <a class="btn btn-primary float-right" href="{{ route('role.create') }}">Create</a>
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
                            @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role["full-access"] }}</td>
                                <td>
                                    @can('haveaccess', 'role.show')
                                        <a class="btn btn-success" href="{{ route('role.show', $role->id) }}">Show</a>
                                    @endcan

                                </td>
                                <td>
                                    @can('haveaccess', 'role.edit')
                                        <a class="btn btn-info" href="{{ route('role.edit', $role->id) }}">Edit</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('haveaccess', 'role.destroy')
                                        <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    @endcan
                                    
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{  $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
