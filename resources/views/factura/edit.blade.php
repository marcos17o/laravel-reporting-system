@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header"><h2>Edit factura</h2></div>

                <div class="card-body">
                    @include('custom.mensaje')

                    <form action="{{ route('factura.update', $factura->id) }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                        <div class="container">

                            <h3>Required Data</h3>

                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name', $factura->name) }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ old('slug', $factura->slug) }}">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description" id="description" name="description" rows="3">{{ old('description', $factura->description) }}</textarea>
                            </div>

                            <hr>



                            <h3>Full Access</h3>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessyes" name="full-access" class="custom-control-input"
                                    value="yes"
                                    @if($factura['full-access'] == 'yes')
                                        checked
                                    @elseif (old('full-access') == 'yes')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="fullaccessyes"  >Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessno" name="full-access" class="custom-control-input"
                                    value="no"
                                    @if($factura['full-access'] == 'no')
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
                                        <input type="checkbox" class="custom-control-input"
                                            id="permission_{{ $permission->id }}"
                                            value="{{ $permission->id }}"
                                            name="permission[]"
                                            @if (is_array(old('permission')) && in_array($permission->id, old('permission')))

                                            @elseif(is_array($permissions_factura) && in_array($permission->id, $permissions_factura))
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
                            <input type="submit" value="Save" class="btn btn-primary">
                            <a class="btn btn-danger" href="{{route('factura.index') }}">Back</a>


                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
