@extends('layouts.app-2')

@section('content')
{{-- {{ $role }} --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>Reportes</h2></div>

                @include('custom.mensaje')

                <div class="card-body">

                    <form>
                        <div class="row">
                            <div class="form-group col-5">
                                <label for="exampleFormControlSelect2">Example multiple select</label>
                                <select multiple class="form-control" id="exampleFormControlSelect2">
                                  @foreach ($role[0]->users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-5">
                                <label for="exampleFormControlSelect2">Example multiple select</label>
                                <select multiple class="form-control" id="exampleFormControlSelect2">
                                  @foreach ($role[0]->users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>


                    <br><br>
                    <hr>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
