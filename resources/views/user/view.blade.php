@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header"><h2>User information: {{ $user->name }}</h2></div>

                <div class="card-body">
                    @include('custom.mensaje')

                    <form action="{{ route('user.update', $user->id) }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                        <div class="container">

                            <h3>Required Data</h3>

                            <div class="form-group">
                                <input disabled type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <input disabled type="email" class="form-control" id="email" placeholder="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="form-group">
                                <select disabled class="form-control" name="roles" id="roles">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}"
                                        @isset($user->roles[0]->name)
                                            @if ($role->name == $user->roles[0]->name)
                                                selected
                                            @endif
                                        @endisset
                                            
                                        >{{$role->id}} - {{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <hr>

                            @can('update', [$user,['user.edit','userown.edit']])
                                <a class="btn btn-success" href="{{ route('user.edit', $user->id) }}">Edit</a>
                            @endcan
                            
                            <a class="btn btn-danger" href="{{route('user.index') }}">Back</a>

                            
                        </div>    
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
