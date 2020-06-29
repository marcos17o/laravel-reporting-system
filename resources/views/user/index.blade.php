@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header"><h2>List of User</h2></div>

                @include('custom.mensaje')

                <div class="card-body">
  
                    <br><br>


                    <table class="table table-hover table-responsive">
                    
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role(s)</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                          
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @isset($user->roles[0]->name)
                                        {{ $user->roles[0]->name }}
                                    @endisset
                                </td>
                                <td>
                                    @can('view', [$user,['user.show','userown.show']])
                                        <a class="btn btn-success" href="{{ route('user.show', $user->id) }}">Show</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('update', [$user,['user.edit','userown.edit']])
                                        <a class="btn btn-info" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('haveaccess', 'user.destroy')
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
                    {{  $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
