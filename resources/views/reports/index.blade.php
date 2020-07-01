@extends('layouts.app-2')

@section('content')
{{-- {{ $role }} --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="text-center">
                <h2>En construccion</h2>
                <img src="https://static.wixstatic.com/media/404129_57320dafca4649a38b9f9e7f337e5c49~mv2.gif" alt="En contruccion">
            </div>
                
            <div class="card">
                <div class="card-header"><h2>Reportes (Solo usuarios con el rol Consultor)</h2></div>

                
                @include('custom.mensaje')

                <div class="card-body">


                        {{-- <div class="row">
                            <div class="form-group col-5">
                                <label for="izquierda">Example multiple select</label>
                                <select multiple class="form-control" id="izquierda">
                                  @foreach ($role[0]->users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-1">
                                <button class="btn btn-primary" onclick="Mover(2)"><<<<</button>
                                <button class="btn btn-primary" onclick="Mover(1)">>>>></button>
                            </div>
                            <form>
                                <div class="form-group col-5">
                                    <label for="derecha">Example multiple select</label>
                                    <select multiple class="form-control" id="derecha">

                                    </select>
                            </form>
                            </div> --}}



                        </div >
                        <div class="row" >
                            <div  class="form-group col-3">
                                <select class="form-control form-control-lg" id="list1" multiple>

                                    @foreach ($role[0]->users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                </select>
                            </div>


                            <div class="form-group col-1 m-0">
                                <input class="btn btn-primary p-3 my-1" name="button" type="button" onClick="move(list1,list2)" value=">>">

                                <input class="btn btn-primary p-3" name="button" type="button" onClick="move(list2,list1)" value="<<">
                            </div>

                            <div class="form-group col-3">
                                <select class="form-control form-control-lg" id="list2" multiple>

                                </select>
                            </div>

                        </div>
                        <div class="form-group m-0">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>



                       



                    <br><br>
                    <hr>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
