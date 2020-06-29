@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header"><h2>Edit User</h2></div>

                <div class="card-body">
                    @include('custom.mensaje')

                    <form action="{{ route('user.update', $user->id) }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                        <div class="container">

                            <h3>Required Data</h3>

                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            
                            <div class="form-group">
                                <select class="form-control" name="roles" id="roles">
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

                            <input type="submit" value="Save" class="btn btn-primary">
                            <a class="btn btn-danger" href="{{route('user.index') }}">Back</a>
                            
                            
                        </div>    
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
