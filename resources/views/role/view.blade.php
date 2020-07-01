@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header"><h2>Role information: {{ $role->name }}</h2></div>

                <div class="card-body">
                    @include('custom.mensaje')

                    <form action="{{ route('role.update', $role->id) }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                        <div class="container">

                            <h3>Required Data</h3>

                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name', $role->name) }} readonly">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ old('slug', $role->slug) }} readonly">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description" id="description" name="description" rows="3" readonly>{{ old('description', $role->description) }}</textarea>
                            </div>

                            <hr>



                            <h3>Full Access</h3>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" id="fullaccessyes" name="full-access" class="custom-control-input"
                                    value="yes"
                                    @if($role['full-access'] == 'yes')
                                        checked
                                    @elseif (old('full-access') == 'yes')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="fullaccessyes"  >Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" id="fullaccessno" name="full-access" class="custom-control-input"
                                    value="no"
                                    @if($role['full-access'] == 'no')
                                    checked
                                    @elseif (old('full-access') == 'no')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="fullaccessno"  >No</label>
                            </div>

                            <hr>
                            <div id="permission-list">
                                <h3>Permission List</h3>
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input disabled type="checkbox" class="custom-control-input"
                                            id="permission_{{ $permission->id }}"
                                            value="{{ $permission->id }}"
                                            name="permission[]"
                                            @if (is_array(old('permission')) && in_array($permission->id, old('permission')))

                                            @elseif(is_array($permissions_role) && in_array($permission->id, $permissions_role))
                                                checked
                                            @endif>

                                        <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->id }} -  {{ $permission->name }}
                                            <em>({{ $permission->description }})</em>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr>


                            @can('haveaccess', 'role.edit')
                                <a class="btn btn-success" href="{{ route('role.edit', $role->id) }}">Edit</a>
                            @else
                                <a class="btn btn-success" disable ><i class="fas fa-edit"></i> Edit</a>
                            @endcan
                            <a class="btn btn-danger" href="{{route('role.index') }}">Back</a>



                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header"><h2>Users with this role</h2></div>

                <div class="card-body">
                    <div class="container-fluid">
                        <table class="table table-hover table-responsive">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Email</th>
                                    <th colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role->users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @can('view', [$user,['user.show','userown.show']])
                                         <a class="btn btn-success" href="{{ route('user.show', $user->id) }}">Show</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


        </div>


    </div>
</div>
@endsection
