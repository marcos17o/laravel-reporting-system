@extends('layouts.app-2')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>Reportes</h2></div>

                @include('custom.mensaje')

                <div class="card-body">

                    <form>

                        <select class="form-group selectpicker" multiple data-live-search="true">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                          </select>
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
